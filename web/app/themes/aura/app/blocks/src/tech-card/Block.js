import { RichText, InspectorControls, InnerBlocks } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';

const ALLOWED_BLOCKS = ['create-block/tech-item'];
const BLOCKS_TEMPLATE = [['create-block/tech-item', {}]];

const Block = ({ editmode = false, attributes = {}, setAttributes = () => {} }) => {
  const { title, subtitle } = attributes;

  return (
    <>
      <div className="tech-slider-card__content">
        <div className="tech-slider-card__header flex flex-col md:flex-row justify-between px-[40px] md:items-center">
          <h2 className="title title--h2 rte rte--em-c-5 c--2">
            <span>
              {editmode ? (
                <RichText
                  value={title}
                  onChange={(val) => setAttributes({ title: val })}
                  allowedFormats={['core/bold', 'core/italic']}
                  placeholder="Titre du slide"
                />
              ) : (
                <RichText.Content value={title} />
              )}
              {editmode ? (
                <RichText
                  tagName="small"
                  value={subtitle}
                  onChange={(val) => setAttributes({ subtitle: val })}
                  placeholder="Sous-titre du slide"
                />
              ) : (
                <RichText.Content tagName="small" value={subtitle} />
              )}
            </span>
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
            {editmode ? (
              <InnerBlocks allowedBlocks={ALLOWED_BLOCKS} template={BLOCKS_TEMPLATE} />
            ) : (
              <InnerBlocks.Content />
            )}
          </ul>
        </div>
      </div>
    </>
  );
};

export { Block };
