const Block = ({ editmode = false, attributes = {}, setAttributes = () => {} }) => {
  const { image = {}, button = {} } = attributes;

  return (
    <React.Fragment>
      <div className="block intro-block">
        <div className="intro-block__content uk-container">
          <div className="intro-block__body"></div>
        </div>
      </div>
    </React.Fragment>
  );
};

export { Block };
