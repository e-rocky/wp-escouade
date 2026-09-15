import {
  RichText,
  InnerBlocks,
  InspectorControls,
  MediaUpload,
  MediaUploadCheck,
  URLInput,
} from '@wordpress/block-editor';
import { PanelBody, Button, ToggleControl, SelectControl } from '@wordpress/components';

const BG_OPTIONS = [
  { label: 'Aucun', value: '' },
  { label: 'Background 1', value: 'bgi--1' },
  { label: 'Background 2', value: 'bgi--2' },
  { label: 'Background 3', value: 'bgi--3' },
  { label: 'Background 4', value: 'bgi--4' },
  { label: 'Background 5', value: 'bgi--5' },
  { label: 'Background 6', value: 'bgi--6' },
];

const Block = ({
  editmode = false,
  attributes = {},
  setAttributes = () => {},
  blockProps = {},
}) => {
  const { background, bodyText, image = {}, primaryButton = {}, secondaryButton = {} } = attributes;
  const { url: imgUrl = '', alt: imgAlt = '', id: imgId = null } = image;
  const {
    text: primaryText = '',
    url: primaryUrl = '#',
    openInNewTab: primaryNewTab = false,
  } = primaryButton;
  const {
    text: secondaryText = '',
    url: secondaryUrl = '#',
    openInNewTab: secondaryNewTab = false,
  } = secondaryButton;

  return (
    <React.Fragment>
      {editmode && (
        <InspectorControls>
          <PanelBody title="Arrière-plan" initialOpen={true}>
            <SelectControl
              label="Fond"
              value={background}
              options={BG_OPTIONS}
              onChange={(val) => setAttributes({ background: val })}
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
          <PanelBody title="Bouton principal" initialOpen={false}>
            <URLInput
              label="URL"
              value={primaryUrl}
              onChange={(val) => setAttributes({ primaryButton: { ...primaryButton, url: val } })}
            />
            <ToggleControl
              label="Ouvrir dans un nouvel onglet"
              checked={primaryNewTab}
              onChange={(val) =>
                setAttributes({ primaryButton: { ...primaryButton, openInNewTab: val } })
              }
            />
          </PanelBody>
          <PanelBody title="Bouton secondaire" initialOpen={false}>
            <URLInput
              label="URL"
              value={secondaryUrl}
              onChange={(val) =>
                setAttributes({ secondaryButton: { ...secondaryButton, url: val } })
              }
            />
            <ToggleControl
              label="Ouvrir dans un nouvel onglet"
              checked={secondaryNewTab}
              onChange={(val) =>
                setAttributes({ secondaryButton: { ...secondaryButton, openInNewTab: val } })
              }
            />
          </PanelBody>
        </InspectorControls>
      )}
      <div
        {...blockProps}
        className={`block hero-intro-block bgi ${background} ${blockProps.className ?? ''}`}
      >
        <div className="hero-intro-block__content uk-container">
          <div className="hero-intro-block__body">
            <div className="card hero-intro-card">
              <div className="hero-intro-card__background scale-x-[-1]"></div>

              <div className="hero-intro-card__content flex flex-col lg:flex-row-reverse">
                <div className="hero-intro-card__header">
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
                      <img src={imgUrl} alt={imgAlt} />
                    )}
                  </figure>
                </div>

                <div className="hero-intro-card__body">
                  <div className="rte rte--em-c-2">
                    {editmode ? (
                      <InnerBlocks
                        allowedBlocks={['core/heading']}
                        template={[
                          [
                            'core/heading',
                            {
                              level: 2,
                              placeholder: 'Titre ...',
                              className: 'title title--h2 c--3',
                            },
                          ],
                        ]}
                        templateLock="all"
                      />
                    ) : (
                      <InnerBlocks.Content />
                    )}
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
                    {primaryUrl || secondaryUrl ? (
                      <div className="actions flex flex-col sm:flex-row md:flex-wrap items-stretch gap-[20px]">
                        {editmode
                          ? primaryUrl && (
                              <div className="btn c--4 bgc--5-2 btn-shadow-sm w-a">
                                <RichText
                                  value={primaryText}
                                  onChange={(val) =>
                                    setAttributes({
                                      primaryButton: { ...primaryButton, text: val },
                                    })
                                  }
                                  allowedFormats={[]}
                                  placeholder="Bouton principal…"
                                />
                              </div>
                            )
                          : primaryUrl && (
                              <a
                                className="btn c--4 bgc--5-2 btn-shadow-sm w-a"
                                href={primaryUrl}
                                title={primaryText}
                                target={primaryNewTab ? '_blank' : undefined}
                                rel={primaryNewTab ? 'noreferrer noopener' : undefined}
                              >
                                <RichText.Content tagName="span" value={primaryText} />
                              </a>
                            )}
                        {editmode
                          ? secondaryUrl && (
                              <div className="btn c--1-2 bgc--1-2 bdc--1-2 btn-shadow-sm w-a">
                                <RichText
                                  value={secondaryText}
                                  onChange={(val) =>
                                    setAttributes({
                                      secondaryButton: { ...secondaryButton, text: val },
                                    })
                                  }
                                  allowedFormats={[]}
                                  placeholder="Bouton secondaire…"
                                />
                              </div>
                            )
                          : secondaryUrl && (
                              <a
                                className="btn c--1-2 bgc--1-2 bdc--1-2 btn-shadow-sm w-a"
                                href={secondaryUrl}
                                title={secondaryText}
                                target={secondaryNewTab ? '_blank' : undefined}
                                rel={secondaryNewTab ? 'noreferrer noopener' : undefined}
                              >
                                <RichText.Content tagName="span" value={secondaryText} />
                              </a>
                            )}
                      </div>
                    ) : null}
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
