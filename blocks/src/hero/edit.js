import {
	BlockIcon,
	InnerBlocks,
	InspectorControls,
	useBlockProps,
	BlockControls,
	MediaPlaceholder,
	MediaReplaceFlow,
	withColors,
	URLInput,
	ColorPalette,
	MediaUpload,
} from '@wordpress/block-editor';
import { Button, PanelBody, PanelRow } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { select } from '@wordpress/data';

import classNames from 'classnames';

import ImageSelector from "@ljo-hamburg/gutenberg-image-selector";

const ALLOWED_MEDIA_TYPES = [ 'image' ];

const TEMPLATE = [
	[
		'core/heading',
		{
			placeholder: __( 'Add Heading...', 'site-functionality' ),
			level: 2,
			className: 'hero__title h1',
		},
		[],
	],
	[
		'core/paragraph',
		{
			placeholder: __( 'Add Content...', 'site-functionality' ),
			className: 'hero__content',
		},
		[],
	],
	[
		'core/buttons',
		{
			className: 'hero__buttons',
		},
		[ [ 'core/button', {}, [] ] ],
	],
];

const ALLOWED_BLOCKS = [ 'core/heading', 'core/paragraph', 'core/buttons' ];

const Edit = ( props ) => {
	const {
		attributes: {
			backgroundImageId
		},
		className,
		setAttributes,
	} = props;

	const blockProps = useBlockProps( {
		className: classNames( className, 'hero' ),
	} );

	const backgroundImageUrl = select('core').getMedia(backgroundImageId);
	if( backgroundImageUrl ) {
		console.log( backgroundImageUrl );
	}

	return (
		<div { ...blockProps }
			>
			<>
				<InspectorControls>
					<PanelBody
						title={ __( 'Background Image', 'site-functionality' ) }
						initialOpen={ true }
					>
						<ImageSelector
							imageID={backgroundImageId}
							authMessage={ __( 'You are not permitted to upload images', 'site-functionality' ) }
							label={ __( 'Select Image', 'site-functionality' ) }
							removeLabel={ __( 'Remove Image', 'site-functionality' ) }
							onChange={ (backgroundImageId) => setAttributes({ backgroundImageId } ) }
						/>
					</PanelBody>
				</InspectorControls>
			</>
			<InnerBlocks
				allowedBlocks={ ALLOWED_BLOCKS }
				template={ TEMPLATE }
				templateLock="all"
			/>
		</div>
	);
};

export default Edit;
