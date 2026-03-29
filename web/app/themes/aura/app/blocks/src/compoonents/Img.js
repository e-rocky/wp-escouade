import manifest from '../../../../public/build/manifest.json';

const Img = ({ src, alt }) => {
  return (
    <img src={`${window.auraBuildPath.uri}${manifest[src].file}`} alt={alt} />
  );
}

export { Img };
