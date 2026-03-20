const Block = (props) => {
  console.log(props);
  return (
    <div className="block hero-text-block">
      <div
        className="hero-text-block__content min-h-[60vh] gap-[70px] uk-container"
        uk-scrollspy="cls:uk-animation-fade"
        data-uk-parallax="y: 50vh; opacity: 1, 0;  start: 0; end: 10vh; blur: 0, 0, 20px; scale: 1, 0.5;"
      >
        <div className="hero-text-block__body">
          <h1 className="title title--h1 rte rte--em-c-5">
            <small className="block">
              Une <strong>Escouade</strong>, c'est <em>plus qu'une équipe</em> :
            </small>
            c'est une aventure humaine
          </h1>
        </div>
        <div className="hero-text-block__footer flex justify-center">
          <a
            className="btn c--4 bgc--5-2 btn--lg btn-shadow-lg"
            href="#"
            title="Rejoindre l’aventure"
          >
            Rejoindre l’aventure <i className="es-icon-chevron-right"></i>
          </a>
        </div>
      </div>
    </div>
  );
};

export { Block };
