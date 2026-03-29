import { RichText, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, Button, SelectControl } from '@wordpress/components';

const COLOR_OPTIONS = [
  { label: 'Couleur 2-5', value: 'c--2-5' },
  { label: 'Couleur 2-1', value: 'c--2-1' },
  { label: 'Couleur 2', value: 'c--2' },
  { label: 'Couleur 3', value: 'c--3' },
  { label: 'Couleur 5', value: 'c--5' },
];

const Block = ({ editmode = false, attributes = {}, setAttributes = () => {}, blockProps = {} }) => {
  const { headingText, bodyText, titleColor, image = {} } = attributes;
  const { url: imgUrl = '', alt: imgAlt = '', id: imgId = null } = image;

  return (
    <React.Fragment>
      {editmode && (
        <InspectorControls>
          <PanelBody title="Couleur du titre" initialOpen={true}>
            <SelectControl
              label="Couleur"
              value={titleColor}
              options={COLOR_OPTIONS}
              onChange={(val) => setAttributes({ titleColor: val })}
            />
          </PanelBody>
          <PanelBody title="Image" initialOpen={true}>
            <MediaUploadCheck>
              <MediaUpload
                onSelect={(media) =>
                  setAttributes({ image: { url: media.url, alt: media.alt, id: media.id } })
                }
                allowedTypes={['image']}
                value={imgId}
                render={({ open }) => (
                  <>
                    {imgUrl && <img src={imgUrl} alt={imgAlt} style={{ maxWidth: '100%', marginBottom: '8px' }} />}
                    <Button onClick={open} variant="secondary">
                      {imgUrl ? "Remplacer l'image" : 'Choisir une image'}
                    </Button>
                  </>
                )}
              />
            </MediaUploadCheck>
          </PanelBody>
        </InspectorControls>
      )}
      <div className="card dna-card flex-1 h-full" {...blockProps}>
        <div className="dna-card__content">
          <div className="dna-card__header">
            <figure className="img-container">
              {editmode ? (
                <MediaUploadCheck>
                  <MediaUpload
                    onSelect={(media) =>
                      setAttributes({ image: { url: media.url, alt: media.alt, id: media.id } })
                    }
                    allowedTypes={['image']}
                    value={imgId}
                    render={({ open }) => (
                      <button
                        onClick={open}
                        style={{ cursor: 'pointer', border: 'none', background: 'none', padding: 0, display: 'block', width: '100%' }}
                      >
                        {imgUrl ? (
                          <img src={imgUrl} alt={imgAlt} />
                        ) : (
                          <span className="dna-card__img-placeholder">+ picto</span>
                        )}
                      </button>
                    )}
                  />
                </MediaUploadCheck>
              ) : (
                <img src={imgUrl} alt={imgAlt} />
              )}
            </figure>
          </div>
          <div className="dna-card__body">
            <h3 className={`title title--h3 ${titleColor}`}>
              {editmode ? (
                <RichText
                  tagName="span"
                  value={headingText}
                  onChange={(val) => setAttributes({ headingText: val })}
                  allowedFormats={['core/bold', 'core/italic']}
                  placeholder="Titre…"
                />
              ) : (
                <RichText.Content tagName="span" value={headingText} />
              )}
            </h3>
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
        </div>
      </div>
    </React.Fragment>
  );
};

export { Block };
