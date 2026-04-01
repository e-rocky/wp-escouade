import { RichText } from '@wordpress/block-editor';

const Block = ({
  editmode = false,
  attributes = {},
  setAttributes = () => {},
  blockProps = {},
}) => {
  const {
    section1Heading,
    section1Body,
    section2Heading,
    section2Body,
    section3Heading,
    section3Body,
  } = attributes;

  const sections = (
    <>
      {/* Section 1 - col-span-2, corps libre (InnerBlocks) */}
      <article className="flex col-span-2 flex-col gap-[32px]">
        <h2 className="title title--h3 c--2-1a">
          {editmode ? (
            <RichText
              tagName="span"
              value={section1Heading}
              onChange={(val) => setAttributes({ section1Heading: val })}
              allowedFormats={['core/bold', 'core/italic']}
              placeholder="Titre..."
            />
          ) : (
            <RichText.Content tagName="span" value={section1Heading} />
          )}
        </h2>
        {editmode ? (
          <RichText
            className="text rte"
            identifier="section1Body"
            tagName="div"
            multiline="p"
            value={section1Body}
            onChange={(val) => setAttributes({ section1Body: val })}
            allowedFormats={['core/bold', 'core/italic', 'core/paragraph']}
            placeholder="Contenu..."
          />
        ) : (
          <RichText.Content className="text rte" tagName="div" value={section1Body} />
        )}
      </article>

      {/* Section 2 - liste a puces */}
      <article className="flex flex-col gap-[32px]">
        <h2 className="title title--h3 c--2-1a">
          {editmode ? (
            <RichText
              tagName="span"
              value={section2Heading}
              onChange={(val) => setAttributes({ section2Heading: val })}
              allowedFormats={['core/bold', 'core/italic']}
              placeholder="Titre..."
            />
          ) : (
            <RichText.Content tagName="span" value={section2Heading} />
          )}
        </h2>
        <div className="text rte">
          {editmode ? (
            <RichText
              identifier="section2Body"
              tagName="ul"
              multiline="li"
              value={section2Body}
              onChange={(val) => setAttributes({ section2Body: val })}
              placeholder="Ajouter un element..."
            />
          ) : (
            <RichText.Content tagName="ul" value={section2Body} />
          )}
        </div>
      </article>

      {/* Section 3 - liste a puces, row-start-5 */}
      <article className="flex flex-col gap-[32px] row-start-5">
        <h2 className="title title--h3 c--2-1a">
          {editmode ? (
            <RichText
              tagName="span"
              value={section3Heading}
              onChange={(val) => setAttributes({ section3Heading: val })}
              allowedFormats={['core/bold', 'core/italic']}
              placeholder="Titre..."
            />
          ) : (
            <RichText.Content tagName="span" value={section3Heading} />
          )}
        </h2>
        <div className="text rte">
          {editmode ? (
            <RichText
              identifier="section3Body"
              tagName="ul"
              multiline="li"
              value={section3Body}
              onChange={(val) => setAttributes({ section3Body: val })}
              placeholder="Ajouter un element..."
            />
          ) : (
            <RichText.Content tagName="ul" value={section3Body} />
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
