import { useBlockProps } from '@wordpress/block-editor';
import { Block } from './Block';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
  return (
    <li {...useBlockProps({ className: 'tech-item' })}>
      <Block editmode attributes={attributes} setAttributes={setAttributes} />
    </li>
  );
}
