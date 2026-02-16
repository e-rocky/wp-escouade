import React, { useEffect } from "react";
import CreatableSelect from "react-select/creatable";
import {
  components,
  type ClearIndicatorProps,
  type MultiValueRemoveProps,
} from "react-select";

const Search = () => {
  function handleCheckboxChange(filter: string) {
    const mapSelectedFilters = new Set(selectedFilters);
    return (event: React.ChangeEvent<HTMLInputElement>) => {
      if (event.target.checked) {
        mapSelectedFilters.add(filter);
      } else {
        mapSelectedFilters.delete(filter);
      }
      setSelectedFilters(Array.from(mapSelectedFilters));
    };
  }
  const [windowWidth, setWindowWidth] = React.useState(window.innerWidth);
  const [selectedFilters, setSelectedFilters] = React.useState<string[]>([]);
  const options = [
    { value: "newest", label: "Plus récent" },
    { value: "oldest", label: "Plus ancien" },
  ];
  useEffect(() => {
    const handleResize = () => {
      setWindowWidth(window.innerWidth);
    };
    window.addEventListener("resize", handleResize);
  }, []);
  const filterGroups = [
    {
      title: "Contrat",
      items: [
        { value: "cdi", label: "CDI" },
        { value: "cdd", label: "CDD" },
      ],
    },
    {
      title: "Modalité",
      items: [
        { value: "remote", label: "Remote" },
        { value: "présentiel", label: "Présentiel" },
        { value: "hybride", label: "Hybride" },
      ],
    },
    {
      title: "Niveau",
      items: [
        { value: "junior", label: "Junior" },
        { value: "senior", label: "Senior" },
      ],
    },
  ];
  return (
    <div id="search-card" className="search-card bgc--4">
      <div className="search-card__background bgi bgi--4 h-[10px]"></div>
      <div className="search-card__content flex-col gap-[32px]">
        <div className="search-card__header">
          <h2 className="title title--h3 c--2">Affiner les offres</h2>
        </div>
        <div className="search-card__body flex items-stretch lg:items-start flex-col lg:flex-row gap-[32px] lg:gap-[100px]">
          <div className="search-card__select flex-col flex-1">
            <i className="es-icon-search font-size-[32px] c--2"></i>
            <CreatableSelect
              isClearable
              isMulti
              classNamePrefix="search-card"
              components={{
                DropdownIndicator: () => null,
                IndicatorSeparator: () => null,
                MultiValueRemove: (props: MultiValueRemoveProps) => (
                  <components.MultiValueRemove {...props}>
                    <i className="es-icon-cross font-size-[20px]"></i>
                  </components.MultiValueRemove>
                ),
                ClearIndicator: (props: ClearIndicatorProps) => (
                  <components.ClearIndicator {...props}>
                    <i
                      className="es-icon-cross font-size-[24px]"
                      onMouseDown={(e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        props.clearValue();
                      }}
                    ></i>
                  </components.ClearIndicator>
                ),
                //ClearIndicator: () => <button>effacer</button>,
              }}
            />
            <div className="sortby col-span-2 flex items-center font-size-[14px]">
              <span className="whitespace-nowrap">trier par :</span>
              <CreatableSelect
                isSearchable={false}
                defaultValue={options[0]}
                options={options}
                components={{
                  IndicatorSeparator: () => null,
                  DropdownIndicator: () => (
                    <i className="es-icon-chevron-down font-size-[24px] c--2"></i>
                  ),
                }}
                classNamePrefix="sortby"
              />
            </div>
          </div>
          <div className="search-card__filter [&>svg]:size-[24px]">
            <div className="label">
              <span className="cpt">{selectedFilters.length}</span> filtres
              actifs
            </div>
            <svg aria-hidden="true">
              <use href="/img/design/sprite.svg#filter"></use>
            </svg>
          </div>
          <div
            className="filter attribute-filter"
            {...(windowWidth > 768
              ? {
                  "data-uk-drop":
                    "mode: click; pos: bottom-right; container:#search;",
                }
              : {
                  "data-uk-drop":
                    "mode: click; pos: bottom-right; container:#search-card;",
                })}
          >
            <div className="attribute-filter__content">
              <div className="attribute-filter__header">
                <span
                  className="reset"
                  title="Tout décocher"
                  onClick={() => {
                    setSelectedFilters([]);
                  }}
                >
                  Tout décocher
                </span>
              </div>
              <div className="attribute-filter__body">
                {filterGroups.map((group) => (
                  <div className="filter-list" key={group.title}>
                    <div className="filter-list__header">{group.title}</div>
                    <div className="filter-list__body">
                      {group.items.map((item) => (
                        <label key={`${group.title}-${item.value}`}>
                          <input
                            value={item.value}
                            className="uk-checkbox"
                            type="checkbox"
                            onChange={handleCheckboxChange(item.value)}
                            checked={selectedFilters.includes(item.value)}
                          ></input>
                          {item.label}
                        </label>
                      ))}
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
        <div className="search-card__footer">
          <div className="actions flex flex-col md:flex-row items-center gap-[20px]">
            <a
              className="btn c--4 bgc--5-2 btn-shadow-sm"
              href="#"
              title="Rechercher"
            >
              Rechercher
            </a>
            <div className="label font-size-[14px] font-500">
              78 Offres trouvées
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Search;
