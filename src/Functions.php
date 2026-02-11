<?php declare(strict_types=1);

/*
 * Copyright (c) Igara Studio S.A.
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE file for details.
 */

namespace IgaraStudio;

function visit(?string $path = null, array $options = []):Visit {
  $visit = new Visit($options);
  if ($path)
    $visit->get($path);

  return $visit;
}
