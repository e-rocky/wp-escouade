import { RichText, InspectorControls, URLInput } from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';

const Block = ({ editmode = false, attributes = {}, setAttributes = () => {} }) => {
  const { headingText, bodyText, button = {} } = attributes;
  const { text: btnText, url: btnUrl = '#', openInNewTab = false } = button;

  return (
    <React.Fragment>
      {editmode && (
        <InspectorControls>
          <PanelBody title="Bouton" initialOpen={true}>
            <URLInput
              label="URL du bouton"
              value={btnUrl}
              onChange={(val) => setAttributes({ button: { ...button, url: val } })}
            />
            <ToggleControl
              label="Ouvrir dans un nouvel onglet"
              checked={openInNewTab}
              onChange={(val) => setAttributes({ button: { ...button, openInNewTab: val } })}
            />
          </PanelBody>
        </InspectorControls>
      )}
      <div className="block hero-text-block">
        <div
          className="hero-text-block__content uk-container"
          data-uk-scrollspy="cls:uk-animation-fade"
          data-uk-parallax="x: 100vw; opacity: 1, 0;  start: 0; end: 10vh; blur: 0, 30px;"
        >
          <div className="hero-text-block__body">
            <h1 className="title title--h1 rte rte--em-c-5">
              <small className="block">
                {editmode ? (
                  <RichText
                    tagName="span"
                    value={bodyText}
                    onChange={(val) => setAttributes({ bodyText: val })}
                    allowedFormats={['core/bold', 'core/italic']}
                    placeholder="Sous-titre…"
                  />
                ) : (
                  <RichText.Content tagName="span" value={bodyText} />
                )}
              </small>
              {editmode ? (
                <RichText
                  tagName="span"
                  value={headingText}
                  onChange={(val) => setAttributes({ headingText: val })}
                  allowedFormats={['core/bold', 'core/italic']}
                  placeholder="Titre…"
                />
              ) : (
                <RichText.Content tagName="span" value={headingText} />
              )}
            </h1>
          </div>
          <div className="hero-text-block__footer flex justify-center">
            {editmode
              ? btnUrl && (
                  <div className="btn c--4 bgc--5-2 btn--lg btn-shadow-lg">
                    <RichText
                      onChange={(val) => setAttributes({ button: { ...button, text: val } })}
                      allowedFormats={[]}
                      placeholder="Texte du bouton…"
                      value={btnText}
                    />
                    <i className="es-icon-chevron-right"></i>
                  </div>
                )
              : btnUrl && (
                  <a
                    className="btn c--4 bgc--5-2 btn--lg btn-shadow-lg"
                    href={btnUrl}
                    title={btnText}
                    target={openInNewTab ? '_blank' : undefined}
                    rel={openInNewTab ? 'noreferrer noopener' : undefined}
                  >
                    <RichText.Content tagName="span" value={btnText} />
                    <i className="es-icon-chevron-right"></i>
                  </a>
                )}
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

export { Block };
