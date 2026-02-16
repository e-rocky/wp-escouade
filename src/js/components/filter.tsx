import React from "react";

const Filter = () => {
  return (
    <div id="filter-card" className="block filter-card bgc bgc--4">
      <div className="filter-card__background bgi bgi--4 h-[10px]"></div>
      <div className="filter-card__content">
        <div className="filter-card__header">
          <h2 className="title title--h3 c--2">Affiner les offres</h2>
        </div>
        <div className="filter-card__body"></div>
        <div className="filter-card__footer">
          <div className="actions flex items-center gap-[20px]">
            <a
              className="btn c--4 bgc--5-2 btn-shadow-sm"
              href="#"
              title="Rechercher"
            >
              Rechercher
            </a>
            <div className="label">78 Offres trouvées</div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Filter;
