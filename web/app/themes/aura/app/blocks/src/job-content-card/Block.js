import { InnerBlocks, RichText } from '@wordpress/block-editor';

const Block = ({
  editmode = false,
  attributes = {},
  setAttributes = () => {},
  blockProps = {},
}) => {
  const { sectionHeading } = attributes;

  const BLOCKS_TEMPLATE = [['core/list', 'core/paragraph', {}]];
  const ALLOWED_BLOCKS = ['core/list', 'core/paragraph'];

  const sections = (
    <>
      {/* Section 1 - col-span-2, corps libre (InnerBlocks) */}
      <article className="flex flex-col gap-[32px] ">
        <h2 className="title title--h3 c--2-1a">
          {editmode ? (
            <RichText
              tagName="span"
              value={sectionHeading}
              onChange={(val) => setAttributes({ sectionHeading: val })}
              allowedFormats={['core/bold', 'core/italic']}
              placeholder="Titre..."
            />
          ) : (
            <RichText.Content tagName="span" value={sectionHeading} />
          )}
        </h2>
        <div className="text rte">
          {editmode ? (
            <InnerBlocks allowedBlocks={ALLOWED_BLOCKS} template={BLOCKS_TEMPLATE} />
          ) : (
            <InnerBlocks.Content />
          )}
        </div>
      </article>
    </>
  );

  return editmode ? (
    <div {...blockProps} className={`content ${blockProps.className ?? ''}`}>
      {sections}
    </div>
  ) : (
    sections
  );
};

export { Block };
