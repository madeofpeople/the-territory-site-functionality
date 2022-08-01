/**
 * External Dependencies
 */
 import classnames from 'classnames';
 
 /**
  * WordPress Dependencies
  */
 const { __ } = wp.i18n;
 const { addFilter } = wp.hooks;
 const { Fragment } = wp.element;
 const { InspectorAdvancedControls } = wp.editor;
 const { createHigherOrderComponent } = wp.compose;
 const { ToggleControl } = wp.components;
 
 const allowedBlocks = [
     'core/cover',
     'core/image'
 ];
 
 /**
  * Add custom attribute for parallax display
  * 
  * @link https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/
  *
  * @param {Object} settings Settings for the block.
  * @return {Object} settings Modified settings.
  */
 function addAttributes(settings) {
     if (typeof settings.attributes !== 'undefined' && allowedBlocks.includes(settings.name)) {
 
         settings.attributes = Object.assign(settings.attributes, {
             isParallax: {
                 type: 'boolean',
                 default: false,
             }
         });
 
     }
 
     return settings;
 }
 
 /**
  * Add parallax controls on Advanced Block Panel.
  * 
  * @link https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/
  *
  * @param {function} BlockEdit Block edit component.
  * @return {function} BlockEdit Modified block edit component.
  */
 const withAdvancedControls = createHigherOrderComponent((BlockEdit) => {
     return (props) => {
 
         const {
             name,
             attributes,
             setAttributes,
             isSelected,
         } = props;
 
         const {
             isParallax,
         } = attributes;
 
 
         return (
             <Fragment>
                 <BlockEdit {...props} />
                 {isSelected && allowedBlocks.includes(name) &&
                     <InspectorAdvancedControls>
                         <ToggleControl
                             label={__('Parallax', 'the-territory')}
                             checked={!!isParallax}
                             onChange={() => setAttributes({ isParallax: !isParallax })}
                             help={!!isParallax ? __('Display as parallax.', 'the-territory') : __('Don\'t display as parallax.', 'the-territory')}
                         />
                     </InspectorAdvancedControls>
                 }
             </Fragment>
         );
     };
 }, 'withAdvancedControls');
 
 /**
  * Add custom element class in save element.
  * 
  * @link https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/
  *
  * @param {Object} extraProps     Block element.
  * @param {Object} blockType      Blocks object.
  * @param {Object} attributes     Blocks attributes.
  * @return {Object} extraProps Modified block element.
  */
 function applyExtraClass(extraProps, blockType, attributes) {
 
     const { isParallax } = attributes;
 
     if (typeof isParallax !== 'undefined' && isParallax && allowedBlocks.includes(blockType.name)) {
         extraProps.className = classnames(extraProps.className, 'lax');
     }
 
     return extraProps;
 }
 
 addFilter(
     'blocks.registerBlockType',
     'editorskit/custom-attributes',
     addAttributes
 );
 
 addFilter(
     'editor.BlockEdit',
     'editorskit/custom-advanced-control',
     withAdvancedControls
 );
 
 addFilter(
     'blocks.getSaveContent.extraProps',
     'editorskit/applyExtraClass',
     applyExtraClass
 );