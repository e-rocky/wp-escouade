import { InnerBlocks, useBlockEditContext } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';

const BLOCKS_TEMPLATE = [
  [
    'create-block/job-content-card',
    { sectionHeading: 'À propos du poste' },
    [
      [
        'core/paragraph',
        {
          content:
            'Dans le cadre de la croissance de nos projets digitaux, nous recherchons un Développeur Back-end PHP Senior pour renforcer notre équipe technique. Vous interviendrez sur des applications web critiques à forte valeur métier, dans un environnement agile, collaboratif et orienté qualité.',
        },
      ],
      [
        'core/paragraph',
        {
          content:
            'Vous travaillerez en étroite collaboration avec les équipes front-end, produit et support afin de concevoir des solutions robustes, performantes et évolutives.',
        },
      ],
    ],
  ],
  [
    'create-block/job-content-card',
    { sectionHeading: 'Vos missions principales' },
    [
      [
        'core/list',
        {},
        [
          [
            'core/list-item',
            { content: 'Concevoir, développer et maintenir des modules back-end en PHP' },
          ],
          [
            'core/list-item',
            {
              content: "Participer à l'architecture et à l'évolution des applications existantes",
            },
          ],
          ['core/list-item', { content: 'Implémenter et maintenir des API REST sécurisées' }],
          [
            'core/list-item',
            {
              content: 'Optimiser les performances et la qualité du code (tests, bonnes pratiques)',
            },
          ],
          [
            'core/list-item',
            {
              content:
                'Collaborer avec les équipes produit et support pour répondre aux besoins métiers',
            },
          ],
          [
            'core/list-item',
            { content: "Participer aux revues de code et à l'amélioration continue" },
          ],
          ['core/list-item', { content: 'Contribuer à la documentation technique' }],
        ],
      ],
    ],
  ],
  [
    'create-block/job-content-card',
    { sectionHeading: 'Profil recherché' },
    [
      [
        'core/list',
        {},
        [
          [
            'core/list-item',
            { content: "Minimum 5 ans d'expérience en développement back-end PHP" },
          ],
          [
            'core/list-item',
            { content: 'Excellente maîtrise de la programmation orientée objet (OOP)' },
          ],
          ['core/list-item', { content: 'Bonne compréhension des architectures web modernes' }],
          [
            'core/list-item',
            { content: 'Capacité à travailler en équipe et à être force de proposition' },
          ],
          ['core/list-item', { content: 'Autonomie, rigueur et sens des responsabilités' }],
        ],
      ],
    ],
  ],
];
const ALLOWED_BLOCKS = ['create-block/job-content-card'];
const MAX_BLOCKS = 3;

const EditInnerBlocks = () => {
  const { clientId } = useBlockEditContext();
  const innerBlockCount = useSelect(
    (select) => select('core/block-editor').getBlockCount(clientId),
    [clientId]
  );

  return (
    <InnerBlocks
      allowedBlocks={ALLOWED_BLOCKS}
      template={BLOCKS_TEMPLATE}
      renderAppender={innerBlockCount < MAX_BLOCKS ? InnerBlocks.ButtonBlockAppender : false}
    />
  );
};

const Block = ({
  editmode = false,
  attributes = {},
  setAttributes = () => {},
  blockProps = {},
}) => {
  const sections = <>{editmode ? <EditInnerBlocks /> : <InnerBlocks.Content />}</>;

  return editmode ? (
    <div {...blockProps} className={`content ${blockProps.className ?? ''}`}>
      {sections}
    </div>
  ) : (
    sections
  );
};

export { Block };
