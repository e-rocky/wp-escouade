import {
  RichText,
  MediaUpload,
  MediaUploadCheck,
  InspectorControls,
} from '@wordpress/block-editor';
import { Button, PanelBody } from '@wordpress/components';

const Block = ({
  editmode = false,
  attributes = {},
  setAttributes = () => {},
  blockProps = {},
}) => {
  const { firstname, lastname, role, quote, image = {} } = attributes;
  const { url: imgUrl = '', alt: imgAlt = '', id: imgId = null } = image;

  return (
    <>
      {editmode && (
        <InspectorControls>
          <PanelBody title="Image" initialOpen={true}>
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
                    className="button button-large"
                    style={{ marginBottom: '8px' }}
                  >
                    {imgUrl ? "Changer l'image" : 'Sélectionner une image'}
                  </button>
                )}
              />
            </MediaUploadCheck>
            {imgUrl && (
              <button
                onClick={() => setAttributes({ image: {} })}
                className="button button-link-delete"
              >
                Supprimer l&apos;image
              </button>
            )}
          </PanelBody>
        </InspectorControls>
      )}
      <div {...blockProps} className={`card talent-card px-[16px] ${blockProps.className ?? ''}`}>
        <div className="talent-card__content">
          <div className="talent-card__header c--4 text-center">
            <h3 className="name title title--h3 c--4">
              {editmode ? (
                <RichText
                  tagName="span"
                  className="firstname"
                  value={firstname}
                  onChange={(val) => setAttributes({ firstname: val })}
                  allowedFormats={[]}
                  placeholder="Prénom…"
                />
              ) : (
                <RichText.Content tagName="span" className="firstname" value={firstname} />
              )}
              {editmode ? (
                <RichText
                  tagName="span"
                  className="lastname"
                  value={lastname}
                  onChange={(val) => setAttributes({ lastname: val })}
                  allowedFormats={[]}
                  placeholder="Nom…"
                />
              ) : (
                <RichText.Content tagName="span" className="lastname" value={lastname} />
              )}
            </h3>
            <div>
              {editmode ? (
                <RichText
                  tagName="span"
                  value={role}
                  onChange={(val) => setAttributes({ role: val })}
                  allowedFormats={[]}
                  placeholder="Titre…"
                />
              ) : (
                <RichText.Content tagName="span" value={role} />
              )}
            </div>
          </div>
          <div className="talent-card__body">
            <div className="img-container">
              {editmode ? (
                <MediaUploadCheck>
                  <MediaUpload
                    onSelect={(media) =>
                      setAttributes({ image: { url: media.url, alt: media.alt, id: media.id } })
                    }
                    allowedTypes={['image']}
                    value={imgId}
                    render={({ open }) => (
                      <>
                        {imgUrl && <img src={imgUrl} alt={imgAlt} />}
                        <Button onClick={open} className="btn-img">
                          Choisir une image
                        </Button>
                      </>
                    )}
                  />
                </MediaUploadCheck>
              ) : (
                <>
                  <img src={imgUrl} alt={imgAlt} />
                  <img src={imgUrl} alt={imgAlt} />
                </>
              )}
            </div>
          </div>
          <div className="talent-card__footer">
            <blockquote>
              <i className="es-icon-quotes"></i>
              <div className="c--3">
                {editmode ? (
                  <RichText
                    tagName="span"
                    value={quote}
                    onChange={(val) => setAttributes({ quote: val })}
                    allowedFormats={['core/bold', 'core/italic']}
                    placeholder="Citation…"
                  />
                ) : (
                  <RichText.Content tagName="span" value={quote} />
                )}
              </div>
            </blockquote>
          </div>
        </div>
      </div>
    </>
  );
};

export { Block };
