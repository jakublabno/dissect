<?php

namespace Dissect\Node;

use RuntimeException;

/**
 * An AST node.
 *
 * @author Jakub Lédl <jakubledl@gmail.com>
 */
class CommonNode implements Node
{
    /**
     * @var array
     */
    protected array $nodes;

    /**
     * @var array
     */
    protected array $attributes;

    /**
     * Constructor.
     *
     * @param array $attributes The attributes of this node.
     * @param array $children The children of this node.
     */
    public function __construct(array $attributes = array(), array $nodes = array())
    {
        $this->attributes = $attributes;
        $this->nodes = $nodes;
    }

    /**
     * {@inheritDoc}
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

    /**
     * {@inheritDoc}
     */
    public function hasNode(string $name): bool
    {
        return isset($this->nodes[$name]);
    }

    /**
     * {@inheritDoc}
     */
    public function getNode(int|string $name)
    {
        if (!isset($this->children[$name])) {
            throw new RuntimeException(sprintf('No child node "%s" exists.', $name));
        }

        return $this->nodes[$name];
    }

    /**
     * {@inheritDoc}
     */
    public function setNode(string $name, Node $child)
    {
        $this->children[$name] = $child;
    }

    /**
     * {@inheritDoc}
     */
    public function removeNode(string $name)
    {
        unset($this->children[$name]);
    }

    /**
     * {@inheritDoc}
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * {@inheritDoc}
     */
    public function hasAttribute(string $key): bool
    {
        return isset($this->attributes[$key]);
    }

    /**
     * {@inheritDoc}
     */
    public function getAttribute(string $key)
    {
        if (!isset($this->attributes[$key])) {
            throw new RuntimeException(sprintf('No attribute "%s" exists.', $key));
        }

        return $this->attributes[$key];
    }

    /**
     * {@inheritDoc}
     */
    public function setAttribute(string $key, mixed $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function removeAttribute(string $key)
    {
        unset($this->attributes[$key]);
    }

    public function count(): int
    {
        return count($this->children);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->children);
    }
}
