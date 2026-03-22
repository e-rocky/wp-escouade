import { InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';

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
  const { background = 'bgc--white' } = attributes;
  const BLOCKS_TEMPLATE = [['create-block/content-card', {}]];
  const ALLOWED_BLOCKS = ['create-block/content-card'];
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
      <div class={`block bgi ${background} edito-block`}>
        <div class="edito-block__content uk-container flex flex-col gap-[64px]">
          <div class="edito-block__body flex flex-col gap-[64px] sm:gap-[76px] md:gap-[88px] lg:gap-[100px]">
            {editmode ? (
              <InnerBlocks allowedBlocks={ALLOWED_BLOCKS} template={BLOCKS_TEMPLATE} />
            ) : (
              <InnerBlocks.Content />
            )}
          </div>
        </div>
      </div>
    </>
  );
};

export { Block };
