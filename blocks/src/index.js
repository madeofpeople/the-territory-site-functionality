import { registerBlockType, registerBlockCollection } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';

import './filters';

import * as linkGroup from './link-group';
import * as pageHeader from './page-header';
import * as pageNav from './page-nav';
import * as socialCards from './social-cards';
import * as tout from './tout';
import * as toutLinked from './tout-linked';

const blocks = [
	linkGroup,
	pageHeader,
	pageNav,
	socialCards,
	tout,
	toutLinked
];

/**
 * Function to register an individual block.
 *
 * @param {Object} block The block to be registered.
 *
 */
const registerBlock = ( block ) => {
	if ( ! block ) {
		return;
	}

	const { name, settings } = block;

	registerBlockType( name, {
		...settings,
	} );
};

/**
 * Function to register blocks
 */
export const registerBlocks = () => {
	blocks.forEach( registerBlock );
};

registerBlocks();
