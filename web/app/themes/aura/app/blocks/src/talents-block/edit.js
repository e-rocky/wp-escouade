import { useBlockProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { store as blockEditorStore } from '@wordpress/block-editor';
import { Block } from './Block';
import './editor.scss';

export default function Edit({ attributes, setAttributes, clientId }) {
  const innerCount = useSelect(
    (select) => select(blockEditorStore).getBlockCount(clientId),
    [clientId]
  );

  return (
    <div {...useBlockProps()}>
      <Block editmode attributes={attributes} setAttributes={setAttributes} innerCount={innerCount} />
    </div>
  );
}
