import { RichText, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';

const Block = ({ editmode = false, attributes = {}, setAttributes = () => {} }) => {
  const { logo = {}, name = 'Technology' } = attributes;
  const { url: logoUrl = '', alt: logoAlt = '' } = logo;

  return (
    <figure>
      <div className="img-container">
        {editmode ? (
          <MediaUploadCheck>
            <MediaUpload
              onSelect={(media) =>
                setAttributes({ logo: { url: media.url, alt: media.alt, id: media.id } })
              }
              allowedTypes={['image']}
              value={logo.id}
              render={({ open }) => (
                <button onClick={open} className="btn-icon">
                  {logoUrl ? (
                    <img src={logoUrl} alt={logoAlt || name} />
                  ) : (
                    <span className="tech-item__logo-placeholder">+ Logo</span>
                  )}
                </button>
              )}
            />
          </MediaUploadCheck>
        ) : (
          <img src={logoUrl} alt={logoAlt || name} />
        )}
      </div>
      <figcaption>
        {editmode ? (
          <RichText
            tagName="span"
            value={name}
            onChange={(val) => setAttributes({ name: val })}
            allowedFormats={[]}
            placeholder="Nom…"
          />
        ) : (
          <RichText.Content tagName="span" value={name} />
        )}
      </figcaption>
    </figure>
  );
};

export { Block };
