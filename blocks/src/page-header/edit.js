import {
	InnerBlocks,
	useBlockProps,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import classNames from 'classnames';

const TEMPLATE = [
	[
		'core/cover',
		{
			className: 'header-banner',
			placeholder: __( 'Add Header Image...', 'site-functionality' ),
			useFeaturedImage: true,
			dimRatio: 0
		},
		[
			[
				'core/group',
				{
					className: 'header-content'

				},
				[
					[
						'core/heading',
						{
							level: 1,
							className: 'header-content-title',
							placeholder: __( 'Add Heading...', 'site-functionality' )
						}
					],
					[
						'core/buttons',
						{
							className: 'header-content-buttons'
						},
						[
							[
								'core/button',
								{
									className: 'header-content-button',
									placeholder: __( 'Add Button...', 'site-functionality' )
								}
							]
						]
					],
				]
			]
		],
	],
];

const ALLOWED_BLOCKS = [ 
	'core/cover',
	'getwid/section',
	'core/post-title',
	'site-functionality/page-nav',
	'core/navigation',
	'core/navigation-link',
	'core/buttons', 
	'core/button', 
	'core/heading', 
	'core/paragraph', 
	'core/group', 
	'core/columns', 
	'core/column', 
	'core/embed',
	'core/video'
];

const Edit = ( props ) => {
	const {
		attributes,
		className,
		setAttributes,
	} = props;

	const blockProps = useBlockProps( {
		className: classNames( className, 'page-header' ),
	} );

	return (
		<div { ...blockProps }
			>
			<InnerBlocks
				allowedBlocks={ ALLOWED_BLOCKS }
				template={ TEMPLATE }
			/>
		</div>
	);
};

export default Edit;
