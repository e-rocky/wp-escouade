import { useBlockProps, RichText } from '@wordpress/block-editor';
import { Block } from './Block';

export default function save({ attributes }) {
  return (
    <li {...useBlockProps.save({ className: 'tech-item' })}>
      <Block attributes={attributes} />
    </li>
  );
}
