import { useBlockProps } from '@wordpress/block-editor';
import { Block } from './Block';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
  return (
      <Block editmode attributes={attributes} setAttributes={setAttributes} />
  );
}
