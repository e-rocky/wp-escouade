import {
  RichText,
  InspectorControls,
  MediaUpload,
  MediaUploadCheck,
  URLInput,
} from '@wordpress/block-editor';
import { PanelBody, ToggleControl, Button, SelectControl } from '@wordpress/components';

const Block = ({ editmode = false, attributes = {}, setAttributes = () => {} }) => {
  const {
    headingText,
    bodyText,
    image = {},
    button = {},
    transparentBackground = false,
    overline = {},
    cardStyle = 0,
  } = attributes;
  const { show: overlineShow = false, text: overlineText } = overline;
  const { text: btnText = button.text, url: btnUrl = '#', openInNewTab = false } = button;
  const { url: imgUrl = '', alt: imgAlt = '' } = image;

  const styles = [
    { titleStyle: 'c--5', buttonStyle: 'bgc--5' },
    { titleStyle: 'c--1a', buttonStyle: 'bgc--1a' },
    { titleStyle: 'c--2-1a', buttonStyle: 'bgc--2' },
    { titleStyle: 'c--5-2', buttonStyle: 'bgc--5' },
    { titleStyle: 'c--2-1a', buttonStyle: 'bgc--1a' },
  ];
  const currentCardStyle = styles[cardStyle] ?? styles[0];

  return (
    <React.Fragment>
      {editmode && (
        <InspectorControls>
          <PanelBody title="Apparence" initialOpen={true}>
            <SelectControl
              label="Style de carte"
              value={cardStyle}
              options={styles.map((style, index) => ({
                label: `Style ${index + 1}`,
                value: index,
              }))}
              onChange={(val) => setAttributes({ cardStyle: val })}
            />
            <ToggleControl
              label="Fond transparent"
              checked={transparentBackground}
              onChange={(val) => setAttributes({ transparentBackground: val })}
            />
            <ToggleControl
              label="Ajouter un surtitre"
              checked={overlineShow}
              onChange={(val) => setAttributes({ overline: { ...overline, show: val } })}
            />
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
                  {imgUrl && <img src={imgUrl} alt={imgAlt} />}
                  <Button onClick={open} className="button button-large">
                    Choisir une image
                  </Button>
                </>
              )}
            />
          </PanelBody>
        </InspectorControls>
      )}
      <div className={`block edito-card ${!transparentBackground ? 'bgc bgc--4' : ''}`}>
        <div className="edito-card__content flex flex-col md:flex-row">
          <div className="edito-card__header">
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
          <div className="edito-card__body">
            <div className="content">
              {overlineShow && (
                <ul className="taglist mb-0 flex flex-wrap gap-[10px] mb-[20px]">
                  <li>
                    <span className="tag">
                      {editmode ? (
                        <RichText
                          tagName="span"
                          value={overlineText}
                          onChange={(val) =>
                            setAttributes({ overline: { ...overline, text: val } })
                          }
                          allowedFormats={[]}
                          placeholder="Surtitre…"
                        />
                      ) : (
                        <RichText.Content tagName="span" value={overlineText} />
                      )}
                    </span>
                  </li>
                </ul>
              )}
              <h2 className={`title title--h3 ${currentCardStyle.titleStyle}`}>
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
                    tagName="div"
                    multiline="p"
                    value={bodyText}
                    onChange={(val) => setAttributes({ bodyText: val })}
                    allowedFormats={['core/bold', 'core/italic']}
                    placeholder="Texte…"
                  />
                ) : (
                  <RichText.Content tagName="div" value={bodyText} />
                )}
              </div>
              <div className="actions">
                {editmode ? (
                  <div className={`btn c--4 ${currentCardStyle.buttonStyle} btn-shadow-sm`}>
                    <RichText
                      onChange={(val) => setAttributes({ button: { ...button, text: val } })}
                      allowedFormats={[]}
                      placeholder="Texte du bouton…"
                      value={btnText}
                    />
                    <i className="es-icon-chevron-right"></i>
                  </div>
                ) : (
                  <a
                    className="btn c--4 bgc--5 btn-shadow-sm"
                    href={btnUrl}
                    title={btnText}
                    target={openInNewTab ? '_blank' : undefined}
                    rel={openInNewTab ? 'noreferrer noopener' : undefined}
                  >
                    <RichText.Content tagName="span" value={btnText} />
                    <i className="es-icon-chevron-right"></i>
                  </a>
                )}
              </div>
            </div>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

export { Block };
