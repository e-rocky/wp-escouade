import { useBlockProps } from '@wordpress/block-editor';
import { Block } from './Block';

export default function save({ attributes }) {
  return (
    <div {...useBlockProps.save()}>
      <Block attributes={attributes} />
    </div>
  );
}
