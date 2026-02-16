import React from "react";
import CreatableSelect from "react-select/creatable";
import {
  components,
  type ClearIndicatorProps,
  type MultiValueRemoveProps,
} from "react-select";

const Filter = () => {
  const options = [
    { value: "newest", label: "Plus récent" },
    { value: "oldest", label: "Plus ancien" },
  ];
  return (
    <div id="search-card" className="search-card bgc--4">
      <div className="search-card__background bgi bgi--4 h-[10px]"></div>
      <div className="search-card__content flex-col gap-[32px]">
        <div className="search-card__header">
          <h2 className="title title--h3 c--2">Affiner les offres</h2>
        </div>
        <div className="search-card__body flex flex-row gap-[100px]">
          <div className="search-card__select flex-1">
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
            <div className="sortby flex items-center font-size-[14px]">
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
            <div className="label">3 filtres actifs</div>
            <svg aria-hidden="true">
              <use href="/img/design/sprite.svg#filter"></use>
            </svg>
          </div>
          <div
            className="filter attribute-filter"
            data-uk-drop="mode: click; pos: bottom-right; container:#search"
          >
            <div className="attribute-filter__content">
              <div className="attribute-filter__body">
                <div className="filter-list">
                  <div className="filter-list__header">Contrat</div>
                  <div className="filter-list__body">
                    <label>
                      <input className="uk-checkbox" type="checkbox"></input>
                      CDI
                    </label>
                    <label>
                      <input className="uk-checkbox" type="checkbox"></input>
                      CDD
                    </label>
                  </div>
                </div>
                <div className="filter-list">
                  <div className="filter-list__header">Modalité</div>
                  <div className="filter-list__body">
                    <label>
                      <input className="uk-checkbox" type="checkbox"></input>
                      Remote
                    </label>
                    <label>
                      <input className="uk-checkbox" type="checkbox"></input>
                      Présentiel
                    </label>
                    <label>
                      <input className="uk-checkbox" type="checkbox"></input>
                      Hybride
                    </label>
                  </div>
                </div>
                <div className="filter-list">
                  <div className="filter-list__header">Niveau</div>
                  <div className="filter-list__body">
                    <label>
                      <input className="uk-checkbox" type="checkbox"></input>
                      Junior
                    </label>
                    <label>
                      <input className="uk-checkbox" type="checkbox"></input>
                      Senior
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div className="search-card__footer">
          <div className="actions flex items-center gap-[20px]">
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

export default Filter;
