import {
  RichText,
  InspectorControls,
  MediaUpload,
  MediaUploadCheck,
  URLInput,
} from '@wordpress/block-editor';
import { PanelBody, Button, ToggleControl } from '@wordpress/components';
import { Img } from '../compoonents/Img';

const Block = ({
  editmode = false,
  attributes = {},
  setAttributes = () => {},
  blockProps = {},
}) => {
  const { headingText, bodyText, image = {}, button = {} } = attributes;
  const { url: imgUrl = '', alt: imgAlt = '', id: imgId = null } = image;
  const { text: btnText = '', url: btnUrl = '#', openInNewTab = false } = button;

  return (
    <React.Fragment>
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
                  <>
                    {imgUrl && (
                      <img
                        src={imgUrl}
                        alt={imgAlt}
                        style={{ maxWidth: '100%', marginBottom: '8px' }}
                      />
                    )}
                    <Button onClick={open} variant="secondary">
                      {imgUrl ? "Remplacer l'image" : 'Choisir une image'}
                    </Button>
                  </>
                )}
              />
            </MediaUploadCheck>
          </PanelBody>
          <PanelBody title="Bouton" initialOpen={true}>
            <URLInput
              label="URL du bouton"
              value={btnUrl}
              onChange={(val) => setAttributes({ button: { ...button, url: val } })}
            />
            <ToggleControl
              label="Ouvrir dans un nouvel onglet"
              checked={openInNewTab}
              onChange={(val) => setAttributes({ button: { ...button, openInNewTab: val } })}
            />
          </PanelBody>
        </InspectorControls>
      )}
      <div
        {...blockProps}
        className={`block cta-image-block bgc bgc--3a ${blockProps.className ?? ''}`}
      >
        <div className="cta-image-block__content uk-container">
          <div className="cta-image-block__body">
            <div className="card cta-card">
              <div className="cta-card__background scale-x-[-1]">
                <Img src="resources/images/design/bg-6.png" />
              </div>

              <div className="cta-card__content flex flex-col-reverse md:flex-row-reverse">
                <div className="cta-card__header">
                  <figure className="img-container">
                    {editmode ? (
                      <MediaUploadCheck>
                        <MediaUpload
                          onSelect={(media) =>
                            setAttributes({
                              image: { url: media.url, alt: media.alt, id: media.id },
                            })
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
                  </figure>
                </div>

                <div className="cta-card__body">
                  <div className="content">
                    <h2 className="title title--h1 c--4">
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
                    </h2>
                    <div className="text">
                      {editmode ? (
                        <RichText
                          tagName="p"
                          value={bodyText}
                          onChange={(val) => setAttributes({ bodyText: val })}
                          allowedFormats={['core/bold', 'core/italic']}
                          placeholder="Texte…"
                        />
                      ) : (
                        <RichText.Content tagName="p" value={bodyText} />
                      )}
                    </div>

                    {editmode
                      ? btnUrl && (
                          <div className="actions flex flex-col sm:flex-row md:flex-wrap items-stretch gap-[20px]">
                            <div className="btn btn--lg c--4 bgc--5 btn-shadow-sm">
                              <RichText
                                value={btnText}
                                onChange={(val) =>
                                  setAttributes({ button: { ...button, text: val } })
                                }
                                allowedFormats={[]}
                                placeholder="Texte du bouton…"
                              />
                              <i className="es-icon-chevron-right"></i>
                            </div>
                          </div>
                        )
                      : btnUrl && (
                          <div className="actions flex flex-col sm:flex-row md:flex-wrap items-stretch gap-[20px]">
                            <a
                              className="btn btn--lg c--4 bgc--5 btn-shadow-sm"
                              href={btnUrl}
                              title={btnText}
                              target={openInNewTab ? '_blank' : undefined}
                              rel={openInNewTab ? 'noreferrer noopener' : undefined}
                            >
                              <RichText.Content tagName="span" value={btnText} />
                              <i className="es-icon-chevron-right"></i>
                            </a>
                          </div>
                        )}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

export { Block };
