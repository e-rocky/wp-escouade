import { useBlockProps } from '@wordpress/block-editor';
import { Block } from './Block';
import './editor.scss';

export default function Edit({ attributes, setAttributes }) {
  const blockProps = useBlockProps();
  return (
      <Block editmode attributes={attributes} setAttributes={setAttributes} blockProps={blockProps}/>
  );
}
