<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following files:</p>
<ul>
	<li>Current theme: <tt><?php echo Yii::app()->getTheme()->getName(); ?></tt></li>
	<li>Current Home URL: <tt><?php echo CHtml::link("Home page", array(Yii::app()->getHomeUrl())); ?></tt></li>
	<li>Skin path: <tt><?php echo Yii::app()->getTheme()->getSkinPath(); ?></tt></li>
	<li>View file: <tt><?php echo __FILE__; ?></tt></li>
	<li>Layout file: <tt><?php echo $this->getLayoutFile('main'); ?></tt></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>

<h2><?php echo Yii::t('webtheme', "Elements Demonstration"); ?></h2>

      <hr>
      <h5>PARAGRAPHS <span class="alt">&amp;</span> BOXES</h5>
      <div class="span-8">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor <sub>sub text</sub> ut labore et <sup>sup text</sup> magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>

      <div class="span-8">
        <p class="small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p class="large">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      </div>

      <div class="span-8 last">

        <div class="box">
          <p class="last">Aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </blockquote>

      </div>
      <hr>

      <h5>LISTS</h5>

      <div class="span-8">
        <ul>
          <li>Unordered list test</li>
          <li>Another list element. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
          <li>Yet another element in the list</li>
          <li>Some long text. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
        </ul>
        <ol>
          <li>Ordered list test</li>
          <li>Another list element</li>
          <li>Yet another element in the list</li>
        </ol>
      </div>

      <div class="span-8">
        <ol>
          <li>Ordered list</li>
          <li>Here's a nested unordered list
          <ul>
            <li>Nested Unordered list</li>
            <li>Nested ordered list
            <ol>
              <li>The first</li>
              <li>And the second</li>
            </ol>
            </li>
          </ul>
          </li>
          <li>Ordered List item</li>
          <li>Nested Ordered list
          <ol>
            <li>Some point</li>
            <li>Nested Unordered list
            <ul>
              <li>The first</li>
              <li>And the second</li>
            </ul>
            </li>
          </ol>
          </li>
        </ol>
      </div>

      <div class="span-8 last">
        <dl>
          <dt>definition list dt</dt>
          <dd>definition list dd</dd>
          <dt>definition list dt</dt>
          <dd>definition list dd</dd>
          <dt>Lorem ipsum dolor sit amet, consectetur adipisicing elit adipisicing elit adipisicing elit</dt>
          <dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit adipisicing elit adipisicing elit</dd>
          <dt>Lorem ipsum dolor sit amet, consectetur adipisicing elit adipisicing elit adipisicing elit</dt>
          <dd>Lorem ipsum dolor sit amet, consectetur adipisicing elit adipisicing elit adipisicing elit</dd>
        </dl>
      </div>
      <hr>

      <h5>HEADINGS</h5>

      <div class="span-8">
        <h1>H1: Lorem ipsum dolor sit amet</h1>
        <h2>H2: Lorem ipsum dolor sit amet, consectetur elit</h2>
        <h3>H3: Lorem ipsum dolor sit amet, consectetur adipisicing elit</h3>
        <h4>H4: Lorem ipsum dolor sit amet, consectetur adipisicing elit adipis</h4>
        <h5>H5: Lorem ipsum dolor sit amet, consectetur adipisicing elit adipisicing elit adipisicing elit</h5>
        <h6>H6: Lorem ipsum dolor sit amet, consectetur adipisicing elit adipisicing elit adipisicing elit</h6>
      </div>

      <div class="span-8">
        <h1>Heading 1</h1><hr>
        <h2>Heading 2</h2><hr>
        <h3>Heading 3</h3><hr>
        <h4>Heading 4</h4><hr>
        <h5>Heading 5</h5><hr>
        <h6>Heading 6</h6>
      </div>

      <div class="span-8 last">
        <h1>Heading 1</h1>
        <h2>Heading 2</h2>
        <h3>Heading 3</h3>
        <h4>Heading 4</h4>
        <h5>Heading 5</h5>
        <h6>Heading 6</h6>
      </div>
      <hr>

      <h5>MISC ELEMENTS</h5>

      <div class="span-8">
        <p>
          <strong>&lt;strong&gt;</strong><br>
          <del>&lt;del&gt; deleted</del><br>
          <dfn>&lt;dfn&gt; dfn</dfn><br>
          <em>&lt;em&gt; emphasis</em>
        </p>
        <p>
          <a>&lt;a&gt; anchor</a><br>
          <a href="http://www.google.com">&lt;a&gt; a + href</a>
        </p>
        <p>
          <abbr title="extended abbr text should show when mouse over">&lt;abbr&gt; abbr - extended text when mouseover.</abbr><br>
          <acronym title="extended acronym text should show when mouse over">&lt;acronym&gt; acronym - extended text when mouseover.</acronym>
        </p>
        <address>
          &lt;address&gt;<br>
          Donald Duck<br>
          Box 555<br>
          Disneyland
        </address>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore.</p>
      </div>

      <div class="span-8">
        <table summary="This is the summary text for this table."  border="0" cellspacing="0" cellpadding="0">
          <caption><em>A standard test table with a caption, tr, td elements</em></caption>
          <tr>
            <th class="span-4">Table Header One</th>
            <th class="span-4 last">Table Header Two</th>
          </tr>
          <tr>
            <td>TD One</td>
            <td>TD Two</td>
          </tr>
          <tr>
            <td colspan="2">TD colspan 2</td>
          </tr>
        </table>

        <table summary="This is the summary text for this table."  border="0" cellspacing="0" cellpadding="0">
          <caption><em>A test table with a thead, tfoot, and tbody elements</em></caption>
          <thead>
            <tr>
              <th class="span-4">Table Header One</th>
              <th class="span-4 last">Table Header Two</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <td colspan="2">tfoot footer</td>
            </tr>
          </tfoot>
          <tbody>
            <tr>
              <td>TD One</td>
              <td>TD Two</td>
            </tr>
            <tr>
              <td>TD One</td>
              <td>TD Two</td>
            </tr>
          </tbody>
          <tbody>
            <tr>
              <td>TD One</td>
              <td>TD Two</td>
            </tr>
            <tr>
              <td>TD One</td>
              <td>TD Two</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="span-8 last">

<pre>&lt;pre&gt;
pre  space1
pre  space1
pre    space2
pre    space2
pre tab
pre tab</pre>

        <code>&lt;code&gt;
          Not indented
          indent1
          indent1
          indent2
          indent3</code>

        <tt>&lt;tt&gt;
          This tt text should be monospaced
          and
          wrap as if
          one line of text
          even though the code has newlines, spaces, and tabs.
          It should be the same size as &lt;p&gt; text.
        </tt>
      </div>
      <hr>
