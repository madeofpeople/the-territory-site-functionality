import {
	InnerBlocks,
	useBlockProps,
} from '@wordpress/block-editor';

import { Placeholder } from '@wordpress/components';
import { external } from '@wordpress/icons';

import { __ } from '@wordpress/i18n';

import classNames from 'classnames';

//  Import CSS.
// import './editor.scss';
// import './style.scss';

const BlockPlaceholder = () => <Placeholder icon={ external } label={ __( 'Social Cards Block', 'site-functionality' ) } />;

const Edit = ( props ) => {
	const {
		attributes,
		isSelected,
		setAttributes,
		className,
	} = props;

	const blockProps = useBlockProps( {
		className: classNames( className, 'social-cards' ),
	} );

	return (
		<div { ...blockProps }>
			<BlockPlaceholder />
		</div>
	);
};

export default Edit;
