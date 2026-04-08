import { RichText, InnerBlocks } from '@wordpress/block-editor';

const BLOCKS_TEMPLATE = [
  ['create-block/talent-card', {}],
  ['create-block/talent-card', {}],
  ['create-block/talent-card', {}],
];
const ALLOWED_BLOCKS = ['create-block/talent-card'];

const Block = ({
  editmode = false,
  attributes = {},
  setAttributes = () => {},
  innerCount = 0,
  blockProps = {},
}) => {
  const { headingText } = attributes;

  return (
    <div
      {...blockProps}
      className={`block bgi bgc--white talents-block ${blockProps.className ?? ''}`}
      data-uk-slider="autoplay:true; pause-on-hover:true; autoplay-interval:5000;"
    >
      <div className="talents-block__content uk-container flex flex-col gap-[70px]">
        <div className="talents-block__header">
          {editmode ? (
            <RichText
              tagName="h2"
              className="title title--h2 rte rte--em-c-5 c--2 mb-0"
              value={headingText}
              onChange={(val) => setAttributes({ headingText: val })}
              allowedFormats={['core/bold', 'core/italic']}
              placeholder="Titre…"
            />
          ) : (
            <RichText.Content
              tagName="h2"
              className="title title--h2 rte rte--em-c-5 c--2 mb-0"
              value={headingText}
            />
          )}
        </div>
        <div className="talents-block__body uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@l uk-slider-items uk-grid mx-[16px] md:mx-[-16px]">
          {editmode ? (
            <InnerBlocks
              allowedBlocks={ALLOWED_BLOCKS}
              template={BLOCKS_TEMPLATE}
              orientation="horizontal"
            />
          ) : (
            <InnerBlocks.Content />
          )}
        </div>
      </div>
    </div>
  );
};

export { Block };
