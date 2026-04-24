import manifest from '../../../../public/build/manifest.json';

const Img = ({ src, alt = '', className }) => {
  return (
    <img className={className} src={`${window.aura.build.uri}${manifest[src].file}`} alt={alt} />
  );
};

export { Img };
