import domReady from '@wordpress/dom-ready';
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/editor';
import { CheckboxControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';

const JobOfferUrgentPanel = () => {
  const postType = useSelect((select) => select('core/editor').getCurrentPostType());

  const [meta, setMeta] = useEntityProp('postType', postType, 'meta');

  if (postType !== 'job-offer') return null;

  return (
    <PluginDocumentSettingPanel name="job-offer-urgent" title="Options">
      <CheckboxControl
        label="Offre urgente"
        checked={meta?.urgent ?? false}
        onChange={(val) => setMeta({ ...meta, urgent: val })}
      />
    </PluginDocumentSettingPanel>
  );
};

registerPlugin('job-offer-urgent-panel', { render: JobOfferUrgentPanel });

domReady(() => {
  //
});
