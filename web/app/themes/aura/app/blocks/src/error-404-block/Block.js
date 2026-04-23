import {
  RichText,
  InspectorControls,
  MediaUpload,
  MediaUploadCheck,
  URLInput,
  InnerBlocks,
} from '@wordpress/block-editor';
import { PanelBody, Button, ToggleControl, SelectControl } from '@wordpress/components';
import { Img } from '../compoonents/Img';

import { useEffect, useMemo } from '@wordpress/element';

const Block = ({
  editmode = false,
  attributes = {},
  setAttributes = () => {},
  blockProps = {},
}) => {
  const { headingText, button = {}, image = {} } = attributes;
  const { text: buttonText = '', url: buttonUrl = '#', openInNewTab = false } = button;
  const { url: imgUrl = '', alt: imgAlt = '', id: imgId = null } = image;
  const ALLOWED_BLOCKS = ['core/paragraph'];
  const DEFAULT_TEMPLATE = [
    [
      'core/paragraph',
      {
        content: 'La page que vous recherchez n’existe pas ou a été déplacée.',
      },
    ],
  ];

  return (
    <React.Fragment>
      {editmode && (
        <InspectorControls>
          <PanelBody title="Bouton" initialOpen={true}>
            <URLInput
              label="URL du bouton"
              value={buttonUrl}
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

      <div {...blockProps} className={`block error_404-block ${blockProps.className ?? ''}`}>
        <div className="error_404-block__content uk-container">
          <div className="error_404-block__body">
            <div className="card error_404-card">
              <div className="error_404-card__content px-[64px]">
                <div className="error_404-card__body">
                  <div className="img-container">
                    <canvas id="canvas" width="300" height="300"></canvas>
                  </div>
                </div>
                <div className="error_404-card__footer pb-[46px]">
                  <div className="content rte text-center flex flex-col items-center [&>h1]:mb-0 gap-[32px]">
                    {editmode ? (
                      <RichText
                        tagName="h1"
                        className="title"
                        value={headingText}
                        onChange={(val) => setAttributes({ headingText: val })}
                        allowedFormats={[]}
                        placeholder="Surtitre…"
                      />
                    ) : (
                      <RichText.Content tagName="h1" className="title" value={headingText} />
                    )}
                    {editmode ? (
                      <InnerBlocks allowedBlocks={ALLOWED_BLOCKS} template={DEFAULT_TEMPLATE} />
                    ) : (
                      <InnerBlocks.Content />
                    )}
                    {editmode
                      ? buttonUrl && (
                          <RichText
                            tagName="a"
                            className="btn c--4 bgc--5-2 btn--lg btn-shadow-lg"
                            value={buttonText}
                            onChange={(val) => setAttributes({ button: { ...button, text: val } })}
                            allowedFormats={[]}
                            placeholder="Texte du bouton…"
                          />
                        )
                      : buttonUrl && (
                          <a
                            className="btn c--4 bgc--5-2 btn--lg btn-shadow-lg"
                            href={buttonUrl}
                            title={buttonText}
                            target={openInNewTab ? '_blank' : undefined}
                            rel={openInNewTab ? 'noopener noreferrer' : undefined}
                          >
                            <RichText.Content tagName="span" value={buttonText} />
                            <i className="es-icon-chevron-right"></i>
                          </a>
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
