import { RichText } from '@wordpress/block-editor';

export const Block = ({
  editmode = false,
  attributes = {},
  setAttributes = () => {},
  blockProps = {},
}) => {
  const { benefitsHeading, benefitsBody } = attributes;

  return (
    <>
      <article className="flex flex-col gap-[32px] ">
        <h2 className="title title--h4 c--3">
          {editmode ? (
            <RichText
              tagName="span"
              value={benefitsHeading}
              onChange={(val) => setAttributes({ benefitsHeading: val })}
              allowedFormats={['core/bold', 'core/italic']}
              placeholder="Pourquoi nous rejoindre ?"
            />
          ) : (
            <RichText.Content tagName="span" value={benefitsHeading} />
          )}
        </h2>
        <div className="text rte">
          {editmode ? (
            <RichText
              identifier="benefitsBody"
              tagName="ul"
              multiline="li"
              value={benefitsBody}
              onChange={(val) => setAttributes({ benefitsBody: val })}
              allowedFormats={['core/bold', 'core/italic', 'core/list-item']}
              placeholder="Ajoutez les avantages..."
            />
          ) : (
            <RichText.Content tagName="ul" value={benefitsBody} />
          )}
        </div>
      </article>
    </>
  );
};
