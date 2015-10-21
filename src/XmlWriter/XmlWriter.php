<?php
/**
 * @link https://github.com/old-town/workflow-designer-server
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Designer\Server\XmlWriter;

use Zend\Config\Writer\Xml;
use XMLWriter as NativeXmlWriter;

/**
 * Class XmlWriter
 *
 * @package ClassifierApi\XmlWriter
 */
class XmlWriter extends Xml
{
    /**
     * processConfig(): defined by AbstractWriter.
     *
     * @param  array $config
     * @return string
     * @throws \Zend\Config\Exception\RuntimeException
     */
    public function processConfig(array $config)
    {
        $writer = new NativeXmlWriter();
        $writer->openMemory();
        $writer->setIndent(true);
        $writer->setIndentString(str_repeat(' ', 4));

        $writer->startDocument('1.0', 'UTF-8');
        $writer->startElement('data');

        foreach ($config as $sectionName => $data) {
            if (!is_array($data)) {
                $writer->writeElement($sectionName, (string) $data);
            } else {
                $this->addBranch($sectionName, $data, $writer);
            }
        }

        $writer->endElement();
        $writer->endDocument();

        return $writer->outputMemory();
    }
}
