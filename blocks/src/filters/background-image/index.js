import { addFilter } from '@wordpress/hooks';
const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;
const { InspectorControls, InnerBlocks, MediaUpload, MediaUploadCheck } = wp.editor;
const { PanelBody, Button, ResponsiveWrapper, Spinner } = wp.components;
const { createHigherOrderComponent, compose } = wp.compose;
const { withSelect } = wp.data;
import classnames from 'classnames';

import ImageSelector from "@ljo-hamburg/gutenberg-image-selector";


const ALLOWED_BLOCKS = [
    'core/button',
    'core/group',
];

const addBackgroundImageAttribute = (settings, name) => {
    if (ALLOWED_BLOCKS.includes(name)) {
        return {
            ...settings,
            attributes: {
                ...attributes,
                backgroundImageId: {
                    default: 0,
                    type: 'number',
                },
            },
        };
    }
    return settings;
}
addFilter(
    'blocks.registerBlockType',
    'site-functionality/block-background-image-attributes',
    addBackgroundImageAttribute
);

const addBackgroundImageControl = createHigherOrderComponent((BlockEdit) => {
    return (props) => {
        const {
            attributes: { backgroundImageId },
            setAttributes,
            name,
        } = props;
        if (!ALLOWED_BLOCKS.includes(name)) {
            return <BlockEdit {...props} />;
        }
        return (
            <>
                <InspectorControls>
                    <PanelBody
                        title={__('Background Image', 'site-functionality')}
                        initialOpen={true}
                    >
                        <ImageSelector
                            imageID={backgroundImageId}
                            authMessage={__('You are not permitted to upload images', 'site-functionality')}
                            label={__('Select Image', 'site-functionality')}
                            removeLabel={__('Remove Image', 'site-functionality')}
                            onChange={(backgroundImageId) => setAttributes({ backgroundImageId })}
                        />
                    </PanelBody>
                </InspectorControls>
            </>
        );
    };
}, 'withInspectorControl');
addFilter(
    'editor.BlockEdit',
    'site-functionality/block-background-image-inspector',
    addBackgroundImageControl,
);

const addBackgroundImageProp = createHigherOrderComponent((BlockListBlock) => {
    return (props) => {
        const {
            attributes: { backgroundImageId },
            setAttributes,
            name,
        } = props;
        if (!ALLOWED_BLOCKS.includes(name)) {
            return <BlockEdit {...props} />;
        }

        const backgroundImageUrl = select('core').getMedia(backgroundImageId);

        return (
            <BlockListBlock
                {...props}
                className={classnames(className, backgroundImageId ? `has-background-image` : '')}
                data-background-image={backgroundImageId}
            />
        );
    };
}, 'withClientIdProp');
addFilter(
    'editor.BlockListBlock',
    'site-functionality/block-background-image-prop',
    addBackgroundImageProp
);