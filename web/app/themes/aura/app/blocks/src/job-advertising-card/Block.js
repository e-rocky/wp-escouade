import {
  RichText,
  InspectorControls,
  MediaUpload,
  MediaUploadCheck,
  URLInput,
} from '@wordpress/block-editor';
import { PanelBody, Button } from '@wordpress/components';
import { Img } from '../compoonents/Img';

const Block = ({
  editmode = false,
  attributes = {},
  setAttributes = () => {},
  blockProps = {},
}) => {
  const { headingText, bodyText, image = {}, url = '' } = attributes;
  const { url: imgUrl = '', alt: imgAlt = '' } = image;

  return (
    <React.Fragment>
      {editmode && (
        <InspectorControls>
          <PanelBody title="Lien" initialOpen={true}>
            <URLInput
              label="URL de la carte"
              value={url}
              onChange={(val) => setAttributes({ url: val })}
            />
          </PanelBody>
          <PanelBody title="Image" initialOpen={true}>
            <MediaUpload
              onSelect={(media) =>
                setAttributes({
                  image: { url: media.url, alt: media.alt, id: media.id },
                })
              }
              allowedTypes={['image']}
              value={image.id}
              render={({ open }) => (
                <>
                  {imgUrl && (
                    <img
                      src={imgUrl}
                      alt={imgAlt}
                      style={{ maxWidth: '100%', marginBottom: '8px' }}
                    />
                  )}
                  <Button onClick={open} className="button button-large">
                    Choisir une image
                  </Button>
                </>
              )}
            />
          </PanelBody>
        </InspectorControls>
      )}
      <div
        {...blockProps}
        className={`slide card job-advertising-card ${blockProps.className ?? ''}`}
      >
        <a href={url || '#'} className="job-advertising-card__content c--4">
          <div className="job-advertising-card__header">
            <figure className="img-container">
              <Img src="resources/images/design/logo--text.svg" alt="Escouade" />
            </figure>
          </div>
          <div className="job-advertising-card__body">
            <strong className="title--overline">
              {editmode ? (
                <RichText
                  tagName="span"
                  value={headingText}
                  onChange={(val) => setAttributes({ headingText: val })}
                  allowedFormats={[]}
                  placeholder="Label…"
                />
              ) : (
                <RichText.Content tagName="span" value={headingText} />
              )}
            </strong>
            <h3 className="title color-inherit">
              {editmode ? (
                <RichText
                  tagName="span"
                  value={bodyText}
                  onChange={(val) => setAttributes({ bodyText: val })}
                  allowedFormats={['core/bold', 'core/italic']}
                  placeholder="Titre du poste…"
                />
              ) : (
                <RichText.Content tagName="span" value={bodyText} />
              )}
            </h3>
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
                    value={image.id}
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
                <img src={imgUrl} alt={imgAlt} />
              )}
            </figure>
          </div>
        </a>
      </div>
    </React.Fragment>
  );
};

export { Block };
