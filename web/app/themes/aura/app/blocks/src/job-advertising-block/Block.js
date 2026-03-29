import { RichText, InnerBlocks, InspectorControls, URLInput } from '@wordpress/block-editor';
import { PanelBody, SelectControl, ToggleControl } from '@wordpress/components';

const BG_OPTIONS = [
  { label: 'Background Blanc', value: '' },
  { label: 'neutre', value: 'bgc--white' },
  { label: 'Background 1', value: 'bgi--1' },
  { label: 'Background 2', value: 'bgi--2' },
  { label: 'Background 3', value: 'bgi--3' },
  { label: 'Background 4', value: 'bgi--4' },
  { label: 'Background 5', value: 'bgi--5' },
];

const Block = ({ editmode = false, attributes = {}, setAttributes = () => {} }) => {
  const { background, headingText, button = {} } = attributes;
  const { text: buttonText = '', url: buttonUrl = '#', openInNewTab = false } = button;
  const BLOCKS_TEMPLATE = [['create-block/job-advertising-card', {}]];
  const ALLOWED_BLOCKS = ['create-block/job-advertising-card'];
  return (
    <>
      {editmode && (
        <InspectorControls>
          <PanelBody title="Arrière-plan" initialOpen={true}>
            <SelectControl
              label="Fond"
              value={background}
              options={BG_OPTIONS}
              onChange={(val) => setAttributes({ background: val })}
            />
          </PanelBody>
          <PanelBody title="Bouton" initialOpen={true}>
            <URLInput
              label="URL du bouton"
              value={buttonUrl}
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
      <div className={`block bgi ${background} job-advertising-block`}>
        <div className="job-advertising-block__content uk-container flex gap-[70px] flex-col">
          <div className="block-header">
            {editmode ? (
              <RichText
                tagName="h2"
                className="title title--h2 rte rte--em-c-5 c--4 mb-0"
                value={headingText}
                onChange={(val) => setAttributes({ headingText: val })}
                allowedFormats={['core/bold', 'core/italic']}
                placeholder="Titre…"
              />
            ) : (
              <RichText.Content
                tagName="h2"
                className="title title--h2 rte rte--em-c-5 c--4 mb-0"
                value={headingText}
              />
            )}
          </div>
          <div className="job-advertising-block__body" data-uk-slider>
            <div className="slider uk-slider-items">
              {editmode ? (
                <InnerBlocks allowedBlocks={ALLOWED_BLOCKS} template={BLOCKS_TEMPLATE} />
              ) : (
                <InnerBlocks.Content />
              )}
            </div>
          </div>
          <div className="job-advertising-block__footer flex justify-center">
            {editmode ? (
              <RichText
                tagName="a"
                className="btn btn--lg c--4 bgc--5 btn-shadow-sm"
                value={buttonText}
                onChange={(val) => setAttributes({ button: { ...button, text: val } })}
                allowedFormats={[]}
                placeholder="Texte du bouton…"
              />
            ) : (
              <a className="btn btn--lg c--4 bgc--5 btn-shadow-sm" href={buttonUrl} title={buttonText} target={openInNewTab ? '_blank' : undefined} rel={openInNewTab ? 'noopener noreferrer' : undefined}>
                <RichText.Content tagName="span" value={buttonText} />
                <i className="es-icon-chevron-right"></i>
              </a>
            )}
          </div>
        </div>
      </div>
    </>
  );
};

export { Block };
