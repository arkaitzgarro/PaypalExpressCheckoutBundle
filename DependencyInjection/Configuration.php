<?php

/**
 * PaypalExpressCheckout for Symfony2
 *
 * This Bundle is part of Symfony2 Payment Suite
 *
 * @author Mickael Andrieu <mickael.andrieu@sensiolabs.com>
 *
 * Mickael Andrieu 2013
 */

namespace PaymentSuite\PaypalExpressCheckoutBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('paypal_express_checkout');

        $rootNode
            ->children()
                ->scalarNode('username')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('password')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('signature')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->booleanNode('debug')
                    ->defaultTrue()
                ->end()
                ->arrayNode('payment_success')
                    ->children()
                        ->scalarNode('route')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->booleanNode('order_append')
                            ->defaultTrue()
                        ->end()
                        ->scalarNode('order_append_field')
                            ->defaultValue('order_id')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('payment_fail')
                    ->children()
                        ->scalarNode('route')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->booleanNode('order_append')
                            ->defaultTrue()
                        ->end()
                        ->scalarNode('order_append_field')
                            ->defaultValue('card_id')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('controller_route')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('en')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->defaultValue('/checkout/payment/paypal_checkout')
                        ->end()
                        ->scalarNode('es')
                            ->defaultValue('/procesar/pago/paypal_checkout')
                        ->end()
                        ->scalarNode('fr')
                            ->defaultValue('/acheter/paiement/paypal_checkout')
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
