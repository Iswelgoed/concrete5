<?php
class ContentPageTranslateTest extends PageTestCase {

    protected $fixtures = array();

    protected function setUp()
    {
        $this->tables = array_merge($this->tables, array(
            'SystemContentEditorSnippets',
        ));
        parent::setUp();
    }

    /**
     * This is taking data OUT of the database and sending it into the page.
     *  @dataProvider contentsFrom
     */
    public function testFrom($from, $to)
    {
        self::createPage('Awesome');
        self::createPage('All Right', '/awesome');
        $c = new \Concrete\Block\Content\Controller();
        $translated = $c->translateFrom($from);
        $this->assertEquals($to, $translated);
    }

    public function contentsFrom()
    {
        return array(
            array('<a href="{CCM:CID_3}">Super Cool!</a>',
                '<a href="' . DIR_REL . '/' . DISPATCHER_FILENAME . '/awesome/all-right">Super Cool!</a>'
            )
        );
    }

}