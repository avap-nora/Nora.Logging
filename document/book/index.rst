.. Nora documentation master file, created by
   sphinx-quickstart on Thu Jan  9 20:44:11 2020.
   You can adapt this file completely to your liking, but it should at least
   contain the root `toctree` directive.

Nora\Logging
================================

ロギング用のライブラリ。

実装方針
-----------------

現段階は、単なる `Monolog <https://tech.quartetcom.co.jp/2018/05/31/monolog/>`_
のラッパーとして作成。

設定
^^^^^

.. literalinclude:: ../../tests/assets/lib/Kernel/Context/TestConfigurator.php
   :language: php

実態
^^^^^

:Kernelで呼び出す方法:
   .. literalinclude:: ../../tests/assets/lib/Kernel/Kernel.php
      :language: php

:Traitで機能を取得する方法:

   .. literalinclude:: ../../src/LoggerTrait.php
      :language: php



Indices and tables
==================

* :ref:`genindex`
* :ref:`modindex`
* :ref:`search`
