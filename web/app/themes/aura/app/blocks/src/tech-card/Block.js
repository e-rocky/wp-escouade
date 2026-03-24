import {
  RichText,
  InspectorControls,
  MediaUpload,
  MediaUploadCheck,
} from '@wordpress/block-editor';
import { PanelBody, Button, TextControl } from '@wordpress/components';

const Block = ({ editmode = false, attributes = {}, setAttributes = () => {} }) => {
  const {
    categoryLabel = 'Backend',
    subtitleText = 'au coeur de nos réalisations',
    items = [],
  } = attributes;

  const updateItem = (index, field, value) => {
    const newItems = items.map((item, i) => (i === index ? { ...item, [field]: value } : item));
    setAttributes({ items: newItems });
  };

  const updateItemLogo = (index, media) => {
    const newItems = items.map((item, i) =>
      i === index ? { ...item, logo: { url: media.url, alt: media.alt, id: media.id } } : item
    );
    setAttributes({ items: newItems });
  };

  const addItem = () => {
    setAttributes({
      items: [...items, { logo: { url: '', alt: '', id: null }, name: 'Technology' }],
    });
  };

  const removeItem = (index) => {
    setAttributes({ items: items.filter((_, i) => i !== index) });
  };

  return (
    <>
      {editmode && (
        <InspectorControls>
          <PanelBody title="Catégorie" initialOpen={true}>
            <TextControl
              label="Sous-titre"
              value={subtitleText}
              onChange={(val) => setAttributes({ subtitleText: val })}
            />
          </PanelBody>
          <PanelBody title="Technologies" initialOpen={true}>
            {items.map((item, index) => (
              <div
                key={index}
                style={{ borderBottom: '1px solid #ddd', paddingBottom: 12, marginBottom: 12 }}
              >
                <TextControl
                  label={`Nom #${index + 1}`}
                  value={item.name || ''}
                  onChange={(val) => updateItem(index, 'name', val)}
                />
                <MediaUploadCheck>
                  <MediaUpload
                    onSelect={(media) => updateItemLogo(index, media)}
                    allowedTypes={['image']}
                    value={item.logo?.id}
                    render={({ open }) => (
                      <>
                        {item.logo?.url && (
                          <img
                            src={item.logo.url}
                            alt={item.logo.alt || item.name}
                            style={{ maxWidth: 60, marginBottom: 4, display: 'block' }}
                          />
                        )}
                        <Button onClick={open} variant="secondary" style={{ marginBottom: 8 }}>
                          {item.logo?.url ? 'Changer le logo' : 'Choisir un logo'}
                        </Button>
                      </>
                    )}
                  />
                </MediaUploadCheck>
                <Button onClick={() => removeItem(index)} variant="link" isDestructive>
                  Supprimer
                </Button>
              </div>
            ))}
            <Button onClick={addItem} variant="primary">
              + Ajouter une technologie
            </Button>
          </PanelBody>
        </InspectorControls>
      )}
      <div className="tech-slider-card__content">
        <div className="tech-slider-card__header flex flex-col md:flex-row justify-between px-[40px] md:items-center">
          <h2 className="title title--h2 rte rte--em-c-5 c--2">
            {'Les technologies '}
            {editmode ? (
              <RichText
                tagName="em"
                value={categoryLabel}
                onChange={(val) => setAttributes({ categoryLabel: val })}
                allowedFormats={[]}
                placeholder="Catégorie…"
              />
            ) : (
              <RichText.Content tagName="em" value={categoryLabel} />
            )}{' '}
            <small>{subtitleText}</small>
          </h2>
          {!editmode && (
            <ul className="nav flex gap-[10px] m-0 justify-start">
              <li>
                <button
                  className="btn c--4 bgc--1-2 btn-shadow-sm px-0 size-[48px] flex items-center justify-center"
                  data-uk-slider-item="previous"
                >
                  <i className="es-icon-chevron-left"></i>
                </button>
              </li>
              <li>
                <button
                  className="btn c--4 bgc--1-2 btn-shadow-sm px-0 size-[48px] flex items-center justify-center"
                  data-uk-slider-item="next"
                >
                  <i className="es-icon-chevron-right"></i>
                </button>
              </li>
            </ul>
          )}
        </div>
        <div className="tech-slider-card__body md:px-[10px] uk-child-width-1-1">
          <ul className="tech-list gap-[10px] gap-y-[20px] md:gap-y-[40px] lg:gap-y-[50px]">
            {items.map((item, index) => (
              <li key={index} className="tech-item">
                <figure>
                  <div className="img-container">
                    {editmode ? (
                      <MediaUploadCheck>
                        <MediaUpload
                          onSelect={(media) => updateItemLogo(index, media)}
                          allowedTypes={['image']}
                          value={item.logo?.id}
                          render={({ open }) => (
                            <button
                              onClick={open}
                              style={{
                                cursor: 'pointer',
                                border: 'none',
                                background: 'none',
                                padding: 0,
                                display: 'block',
                                width: '100%',
                              }}
                            >
                              {item.logo?.url ? (
                                <img src={item.logo.url} alt={item.logo.alt || item.name} />
                              ) : (
                                <span className="tech-item__logo-placeholder">+ Logo</span>
                              )}
                            </button>
                          )}
                        />
                      </MediaUploadCheck>
                    ) : (
                      <img src={item.logo?.url} alt={item.logo?.alt || item.name} />
                    )}
                  </div>
                  <figcaption>{item.name}</figcaption>
                </figure>
              </li>
            ))}
            {editmode && (
              <li className="tech-item">
                <button
                  onClick={addItem}
                  style={{
                    width: '100%',
                    border: '2px dashed #ccc',
                    background: 'none',
                    cursor: 'pointer',
                    padding: '12px',
                    borderRadius: 4,
                  }}
                >
                  + Ajouter
                </button>
              </li>
            )}
          </ul>
        </div>
      </div>
    </>
  );
};

export { Block };
