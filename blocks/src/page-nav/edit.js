import {
	InnerBlocks,
	useBlockProps,
} from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

import classNames from 'classnames';

const TEMPLATE = [
	[
		'core/buttons',
		{
			className: 'menu',
		},
		[ [ 'core/button', 	{
			placeholder: __( 'Add Nav Item...', 'site-functionality' ),
			className: 'menu-item',
		}, [] ] ],
		[ [ 'core/button', 	{
			placeholder: __( 'Add Nav Item...', 'site-functionality' ),
			className: 'menu-item',
		}, [] ] ],
		[ [ 'core/button', 	{
			placeholder: __( 'Add Nav Item...', 'site-functionality' ),
			className: 'menu-item',
		}, [] ] ],
	],
];

const ALLOWED_BLOCKS = [ 'core/buttons', 'core/button' ];

const Edit = ( props ) => {
	const {
		attributes,
		className,
		setAttributes,
	} = props;

	const blockProps = useBlockProps( {
		className: classNames( className, 'page-nav' ),
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
