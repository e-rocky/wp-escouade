import { InnerBlocks, InspectorControls } from '@wordpress/block-editor';
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

const Block = ({ editmode = false, attributes = {}, setAttributes = () => {} }) => {
  const { background = 'bgi--4' } = attributes;
  const BLOCKS_TEMPLATE = [['create-block/tech-card', {}]];
  const ALLOWED_BLOCKS = ['create-block/tech-card'];

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
      <div className={`block bgi ${background} tech-slider-block`}>
        <div
          className="tech-slider-block__content uk-container"
          data-uk-slider="autoplay:true; pause-on-hover:true; autoplay-interval:5000; velocity:0"
        >
          <div className="tech-slider-block__body overflow-x-hidden">
            <div
              className="card tech-slider-card uk-slider-items uk-child-width-1-1"
              data-uk-scrollspy="cls:uk-animation-scale-up; target: .tech-item,h2 em; delay: 35; repeat: true"
            >
              {editmode ? (
                <InnerBlocks allowedBlocks={ALLOWED_BLOCKS} template={BLOCKS_TEMPLATE} />
              ) : (
                <InnerBlocks.Content />
              )}
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export { Block };
