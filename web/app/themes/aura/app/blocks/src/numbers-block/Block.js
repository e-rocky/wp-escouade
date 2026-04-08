import { RichText, InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';

const BG_OPTIONS = [
  { label: 'Aucun', value: '' },
  { label: 'Background 1', value: 'bgi--1' },
  { label: 'Background 2', value: 'bgi--2' },
  { label: 'Background 3', value: 'bgi--3' },
  { label: 'Background 4', value: 'bgi--4' },
  { label: 'Background 5', value: 'bgi--5' },
  { label: 'Background 6', value: 'bgi--6' },
];

const MAX_ITEMS = 4;

const BLOCKS_TEMPLATE = [
  ['create-block/numbers-item', { value: '14', suffix: '+', label: "Ans d'expérience" }],
  ['create-block/numbers-item', { value: '20', suffix: '+', label: 'Collaborateurs' }],
  ['create-block/numbers-item', { value: '80', suffix: '%', label: 'Satisfaction client' }],
  ['create-block/numbers-item', { value: '200', suffix: '+', label: 'Projets réalisés' }],
];
const ALLOWED_BLOCKS = ['create-block/numbers-item'];

const Block = ({ editmode = false, attributes = {}, setAttributes = () => {}, innerCount = 0 }) => {
  const { background, headingText, headingSmall } = attributes;

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
        </InspectorControls>
      )}
      <div className={`block numbers-block bgi ${background}`}>
        <div className="numbers-block__content uk-container text-center flex flex-col gap-[32px]">
          <div className="numbers-block__header">
            <h2 className="title title--h2 c--4 [&_small]:font-500">
              {editmode ? (
                <>
                  <RichText
                    tagName="span"
                    value={headingText}
                    onChange={(val) => setAttributes({ headingText: val })}
                    allowedFormats={['core/bold', 'core/italic']}
                    placeholder="Titre…"
                  />{' '}
                  <small>
                    <RichText
                      tagName="span"
                      value={headingSmall}
                      onChange={(val) => setAttributes({ headingSmall: val })}
                      allowedFormats={['core/bold', 'core/italic']}
                      placeholder="Sous-titre…"
                    />
                  </small>
                </>
              ) : (
                <>
                  <RichText.Content tagName="span" value={headingText} />{' '}
                  <small>
                    <RichText.Content tagName="span" value={headingSmall} />
                  </small>
                </>
              )}
            </h2>
          </div>
          <div className="numbers-block__body">
            <div className="card numbers-card">
              <div className="numbers-card__content">
                <div
                  className="numbers-card__body grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 w-full justify-between"
                  data-uk-grid="margin: spacer;"
                >
                  {editmode ? (
                    <InnerBlocks
                      allowedBlocks={ALLOWED_BLOCKS}
                      template={BLOCKS_TEMPLATE}
                      renderAppender={
                        innerCount >= MAX_ITEMS ? false : InnerBlocks.ButtonBlockAppender
                      }
                    />
                  ) : (
                    <InnerBlocks.Content />
                  )}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export { Block };
