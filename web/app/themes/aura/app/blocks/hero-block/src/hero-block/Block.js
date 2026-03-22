import { RichText, LinkControl, InspectorControls  } from "@wordpress/block-editor";

import {
  PanelBody,
  TextControl,
  ToggleControl
} from '@wordpress/components';

const Block = ({ editmode = false, attributes = {}, setAttributes = () => {} }) => {
  const {
    smallText,
    headingText,
    buttonText,
    button = {},
  } = attributes;
  const { text: btnText = buttonText, url: btnUrl = '#', openInNewTab = false } = button;

  return (
		<React.Fragment>
			{editmode && (
			<InspectorControls>
        <PanelBody title="Bouton" initialOpen={true}>
          <TextControl
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
        className="hero-text-block__content min-h-[60vh] gap-[70px] uk-container"
        uk-scrollspy="cls:uk-animation-fade"
        data-uk-parallax="y: 50vh; opacity: 1, 0;  start: 0; end: 10vh; blur: 0, 0, 20px; scale: 1, 0.5;"
      >
        <div className="hero-text-block__body">
          <h1 className="title title--h1 rte rte--em-c-5">
            <small className="block">
              {editmode ? (
                <RichText
                  tagName="span"
                  value={smallText}
                  onChange={(val) => setAttributes({ smallText: val })}
                  allowedFormats={["core/bold", "core/italic"]}
                  placeholder="Texte secondaire…"
                />
              ) : (
                <RichText.Content tagName="span" value={smallText} />
              )}
            </small>
            {editmode ? (
              <RichText
                tagName="span"
                value={headingText}
                onChange={(val) => setAttributes({ headingText: val })}
                allowedFormats={[]}
                placeholder="Titre principal…"
              />
            ) : (
              <RichText.Content tagName="span" value={headingText} />
            )}
          </h1>
        </div>
        <div className="hero-text-block__footer flex justify-center">
          {editmode ? (
            <div className="flex flex-col items-center gap-[8px]">
							<div
                tagName="span"
                className="btn c--4 bgc--5-2 btn--lg btn-shadow-lg"
                value={btnText}>
								<RichText
									onChange={(val) => setAttributes({ button: { ...button, text: val } })}
									allowedFormats={[]}
									placeholder="Texte du bouton…"
								/>
								<i className="es-icon-chevron-right"></i>
							</div>
            </div>
          ) : (
            <a
              className="btn c--4 bgc--5-2 btn--lg btn-shadow-lg"
              href={btnUrl}
              title={btnText}
              target={openInNewTab ? '_blank' : undefined}
              rel={openInNewTab ? 'noreferrer noopener' : undefined}
            >
              <RichText.Content tagName="span" value={btnText} />{" "}
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
