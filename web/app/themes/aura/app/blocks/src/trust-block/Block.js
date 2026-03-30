import { RichText, InnerBlocks } from '@wordpress/block-editor';

const BLOCKS_TEMPLATE = [
  ['create-block/trust-card', {}],
  ['create-block/trust-card', {}],
  ['create-block/trust-card', {}],
];
const ALLOWED_BLOCKS = ['create-block/trust-card'];

const MAX_CARDS = 3;

const Block = ({ editmode = false, attributes = {}, setAttributes = () => {}, innerCount = 0, blockProps={} }) => {
  const { headingText, bodyText } = attributes;

  return (
    <>
      <div {...blockProps} className={`block dna-block ${blockProps.className ?? ''}`}>
        <div className="dna-block__content uk-container flex flex-col gap-[64px]">
          <div className="dna-block__header text-center">
            {editmode ? (
              <RichText
                tagName="h2"
                className="title title--h2 c--2 rte--em-c-5 mb-0 text-[48px]"
                value={headingText}
                onChange={(val) => setAttributes({ headingText: val })}
                allowedFormats={['core/bold', 'core/italic']}
                placeholder="Titre…"
              />
            ) : (
              <RichText.Content
                tagName="h2"
                className="title title--h2 c--2 rte--em-c-5 mb-0 text-[48px]"
                value={headingText}
              />
            )}
            {editmode ? (
              <RichText
                tagName="p"
                value={bodyText}
                onChange={(val) => setAttributes({ bodyText: val })}
                allowedFormats={['core/bold', 'core/italic']}
                placeholder="Description…"
              />
            ) : (
              <RichText.Content tagName="p" value={bodyText} />
            )}
          </div>
          <div className="dna-block__body grid grid-cols-1 md:grid-cols-3 gap-[32px]">
            {editmode ? (
              <InnerBlocks
                allowedBlocks={ALLOWED_BLOCKS}
                template={BLOCKS_TEMPLATE}
                renderAppender={innerCount >= MAX_CARDS ? false : InnerBlocks.ButtonBlockAppender}
              />
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
