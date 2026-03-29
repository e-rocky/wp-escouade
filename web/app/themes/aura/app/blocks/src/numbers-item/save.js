import { useBlockProps } from '@wordpress/block-editor';
import { Block } from './Block';

export default function save({ attributes }) {
  return (
      <Block attributes={attributes} />
  );
}
