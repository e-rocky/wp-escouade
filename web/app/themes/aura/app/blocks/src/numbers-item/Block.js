import { RichText } from '@wordpress/block-editor';

const Block = ({ editmode = false, attributes = {}, setAttributes = () => {}, blockProps = {} }) => {
  const { value, suffix, label } = attributes;

  return (
    <h3 className="number" {...blockProps}>
      <div className="number-value">
        {editmode ? (
          <RichText
            tagName="span"
            value={value}
            onChange={(val) => setAttributes({ value: val })}
            allowedFormats={[]}
            placeholder="0"
          />
        ) : (
          <RichText.Content tagName="span" value={value} />
        )}
        {editmode ? (
          <sup>
            <RichText
              tagName="span"
              value={suffix}
              onChange={(val) => setAttributes({ suffix: val })}
              allowedFormats={[]}
              placeholder="+"
            />
          </sup>
        ) : (
          <sup>
            <RichText.Content tagName="span" value={suffix} />
          </sup>
        )}
      </div>
      <div className="number-label">
        {editmode ? (
          <RichText
            tagName="span"
            value={label}
            onChange={(val) => setAttributes({ label: val })}
            allowedFormats={['core/bold', 'core/italic']}
            placeholder="Label…"
          />
        ) : (
          <RichText.Content tagName="span" value={label} />
        )}
      </div>
    </h3>
  );
};

export { Block };
