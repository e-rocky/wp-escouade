import React, { useEffect } from 'react';
interface OptionType {
  value: string;
  label: string;
}

import CreatableSelect from 'react-select/creatable';
import {
  components,
  //type ActionMeta,
  type ClearIndicatorProps,
  type MultiValue,
  type MultiValueRemoveProps,
} from 'react-select';

interface TaxonomyItem {
  count: number;
  description: string;
  filter: string;
  name: string;
  parent: number;
  slug: string;
  taxonomy: string;
  term_group: number;
  term_id: number;
  term_taxonomy_id: number;
}
declare global {
  interface Window {
    aura: {
      taxonomy: {
        jobDepartment: TaxonomyItem[];
        jobDuration: TaxonomyItem[];
        jobLanguage: TaxonomyItem[];
        jobLevel: TaxonomyItem[];
        jobLocation: TaxonomyItem[];
        jobStack: TaxonomyItem[];
        jobWorkplace: TaxonomyItem[];
      };
    };
  }
}

const Search = () => {
  function handleSearchFilterChange(
    filter: TaxonomyItem,
    event: React.ChangeEvent<HTMLInputElement>
  ) {
    const newSelectedFilters = new Map(selectedFilters);

    if (event.target.checked) {
      newSelectedFilters.set(filter.slug, filter);
    } else {
      newSelectedFilters.delete(filter.slug);
    }

    setSelectedFilters(newSelectedFilters);
  }

  const [windowWidth, setWindowWidth] = React.useState(window.innerWidth);
  const [urlFilter, setUrlFilter] = React.useState<string>('');
  const [urlOrder, setUrlOrder] = React.useState<string>('');
  const [selectedFilters, setSelectedFilters] = React.useState<Map<String, TaxonomyItem>>(
    new Map()
  );
  /*const [jobDurationParam, setJobDurationParam] = React.useState<MultiValue<unknown>>([]);
  const [jobDepartmentParam, setJobDepartmentParam] = React.useState<MultiValue<unknown>>([]);
  const [jobLanguageParam, setJobLanguageParam] = React.useState<MultiValue<unknown>>([]);
  const [jobLevelParam, setJobLevelParam] = React.useState<MultiValue<unknown>>([]);
  const [jobLocationParam, setJobLocationParam] = React.useState<MultiValue<unknown>>([]);
  const [jobWorkplaceParam, setJobWorkplaceParam] = React.useState<MultiValue<unknown>>([]);*/
  const [jobStackParam, setJobStackParam] = React.useState<OptionType[]>([]);
  const options: OptionType[] = [
    { value: 'DESC', label: 'Plus récent' },
    { value: 'ASC', label: 'Plus ancien' },
  ];
  useEffect(() => {
    const handleResize = () => {
      setWindowWidth(window.innerWidth);
    };
    window.addEventListener('resize', handleResize);

    const params = new URLSearchParams(window.location.search);
    params.delete('s');
    params.delete('post_type');
    setUrlOrder(params.get('order') || 'DESC');
    params.delete('order');
    setJobStackParam(
      (params.get('job-stack')?.split(',') || []).map((value) => ({ value, label: value }))
    );
    params.delete('job-stack');

    const filterMap = new Map();
    for (const [key, value] of params.entries()) {
      const values = value.split(',');
      for (const val of values) {
        //filterMap.set(val, key);
        const taxonomies = Object.values(window.aura.taxonomy).flat();
        const taxonomyItem = taxonomies.find((item) => item.slug === val && item.taxonomy === key);
        filterMap.set(val, taxonomyItem);
      }
    }

    setSelectedFilters(filterMap);
  }, []);
  useEffect(() => {
    let serializedFilters = new Map<string, string>();
    selectedFilters.forEach((value, _) => {
      if (!serializedFilters.has(value.taxonomy)) {
        serializedFilters.set(value.taxonomy, value.slug);
      } else {
        serializedFilters.set(
          value.taxonomy,
          serializedFilters.get(value.taxonomy) + ',' + value.slug
        );
      }
    });

    let _urlFilter: string = window.location.origin + '/?s=&post_type=job-offer';
    if (selectedFilters.size > 0) {
      _urlFilter +=
        '&' +
        Array.from(serializedFilters)
          .map(([key, value]) => `${key}=${value}`)
          .join('&');
    }

    if (jobStackParam.length > 0) {
      _urlFilter += '&job-stack=' + jobStackParam.map((tech) => tech.value).join(',');
    }

    if (urlOrder) {
      _urlFilter += '&order=' + urlOrder;
    }

    setUrlFilter(_urlFilter);

    console.log(selectedFilters);

    //updateUrlFilter();
  }, [selectedFilters, jobStackParam, urlOrder]);

  const filterGroups: Array<0 | { title: string; items: TaxonomyItem[] }> = [
    window.aura.taxonomy.jobDuration.length && {
      title: 'Contrat',
      items: window.aura.taxonomy.jobDuration,
    },
    window.aura.taxonomy.jobWorkplace.length && {
      title: 'Modalité',
      items: window.aura.taxonomy.jobWorkplace,
    },
    window.aura.taxonomy.jobLevel.length && {
      title: 'Niveau',
      items: window.aura.taxonomy.jobLevel,
    },
    window.aura.taxonomy.jobDepartment.length && {
      title: 'Département',
      items: window.aura.taxonomy.jobDepartment,
    },
  ];
  const jobStack = window.aura.taxonomy.jobStack.map(function (tech) {
    return { value: tech.slug, label: tech.name };
  });
  const toggleFilters = () => {
    if (selectedFilters.size > 0) {
      setSelectedFilters(new Map());
    } else {
      const allFilters: Map<String, TaxonomyItem> = new Map();
      filterGroups
        .filter((group) => group !== 0)
        .reduce((filters, group) => {
          group.items.forEach((item) => {
            filters.set(item.slug, item);
          });
          return filters;
        }, allFilters);
      setSelectedFilters(allFilters);
    }
  };
  return (
    <div id="search-card" className="search-card text-[14px]">
      <div className="search-card__content flex-col gap-[32px]">
        <div className="search-card__header">
          <h2 className="title title--h3 c--2">Affiner les offres</h2>
        </div>
        <div className="search-card__body flex items-stretch lg:items-start flex-col lg:flex-row gap-[32px] lg:gap-[100px]">
          <div className="search-card__select flex-col flex-1">
            <i className="es-icon-search text-[32px] c--2"></i>
            <CreatableSelect
              isClearable
              isMulti
              classNamePrefix="search-card"
              options={jobStack}
              defaultValue={jobStack.filter((tech) =>
                (
                  new URLSearchParams(window.location.search).get('job-stack')?.split(',') || []
                ).includes(tech.value)
              )}
              components={{
                SelectContainer: (props) => (
                  <components.SelectContainer {...props}>
                    <div className="search-card__select-container">
                      <div className="search-card__select-label">Vos technos</div>
                      {props.children}
                    </div>
                  </components.SelectContainer>
                ),
                DropdownIndicator: () => null,
                IndicatorSeparator: () => null,
                MultiValueRemove: (props: MultiValueRemoveProps) => (
                  <components.MultiValueRemove {...props}>
                    <i className="es-icon-cross text-[20px]"></i>
                  </components.MultiValueRemove>
                ),
                ClearIndicator: (props: ClearIndicatorProps) => (
                  <components.ClearIndicator {...props}>
                    <i
                      className="es-icon-cross text-[24px]"
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
              onChange={(newValue: MultiValue<unknown>, _) => {
                setJobStackParam(newValue);
              }}
            />
            <div className="sortby col-span-2 flex items-center">
              <span className="whitespace-nowrap">trier par :</span>
              <CreatableSelect
                isSearchable={false}
                defaultValue={
                  options.find(
                    (option) =>
                      option.value === new URLSearchParams(window.location.search).get('order')
                  ) || options[0]
                }
                options={options}
                components={{
                  IndicatorSeparator: () => null,
                  DropdownIndicator: () => (
                    <i className="es-icon-chevron-down text-[24px] c--2"></i>
                  ),
                }}
                onChange={(newValue) => {
                  setUrlOrder(newValue?.value || '');
                }}
                classNamePrefix="sortby"
              />
            </div>
          </div>
          <div className="search-card__filter [&>svg]:size-[24px]">
            <div className="label">
              <span className="cpt">{selectedFilters.size} </span> filtre
              {selectedFilters.size > 1 ? 's actifs' : ' actif'}
            </div>
            <svg aria-hidden="true">
              <use href="/resources/images/design/sprite.svg#filter"></use>
            </svg>
          </div>
          <div
            className="filter attribute-filter"
            {...(windowWidth > 768
              ? {
                  'data-uk-drop': 'mode: click; pos: bottom-right; container:#search;',
                }
              : {
                  'data-uk-drop': 'mode: click; pos: bottom-right; container:#search-card;',
                })}
          >
            <div className="attribute-filter__content">
              <div className="attribute-filter__header">
                <span className="reset" onClick={() => toggleFilters()}>
                  {`Tout ${selectedFilters.size > 0 ? 'décocher' : 'cocher'}`}
                </span>
              </div>
              <div className="attribute-filter__body">
                {filterGroups.map(
                  (group: 0 | { title: string; items: TaxonomyItem[] }) =>
                    group && (
                      <div className="filter-list" key={group.title}>
                        <div className="filter-list__header">{group.title}</div>
                        <div className="filter-list__body">
                          {group.items.map((item) => (
                            <label key={`${group.title}-${item.slug}`}>
                              <input
                                value={item.name}
                                className="uk-checkbox"
                                type="checkbox"
                                onChange={(e) => handleSearchFilterChange(item, e)}
                                checked={selectedFilters.has(item.slug)}
                              ></input>
                              {item.name}
                            </label>
                          ))}
                        </div>
                      </div>
                    )
                )}
              </div>
            </div>
          </div>
        </div>
        <div className="search-card__footer">
          <div className="actions flex flex-col md:flex-row items-center gap-[20px]">
            <a className="btn c--4 bgc--5-2 btn-shadow-sm" title="Rechercher" href={urlFilter}>
              Rechercher
            </a>
            <div className="label font-500">78 Offres trouvées</div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Search;
