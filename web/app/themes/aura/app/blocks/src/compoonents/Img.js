import manifest from '../../../../public/build/manifest.json';

const Img = ({ src, alt = '', className }) => {
  return (
    <img className={className} src={`${window.auraBuildPath.uri}${manifest[src].file}`} alt={alt} />
  );
};

export { Img };
