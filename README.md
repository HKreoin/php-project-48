### Hexlet tests and linter status:

[![Actions Status](https://github.com/HKreoin/php-project-48/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/HKreoin/php-project-48/actions)
[![Maintainability](https://api.codeclimate.com/v1/badges/44bbb741ba8fbe2b9ec5/maintainability)](https://codeclimate.com/github/HKreoin/php-project-48/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/44bbb741ba8fbe2b9ec5/test_coverage)](https://codeclimate.com/github/HKreoin/php-project-48/test_coverage)

# Gendiff program

Console program that determines the difference between two data structures.

## Install

```bash
git clone https://github.com/HKreoin/php-project-48.git
cd php-project-48
make install
```

## Features 

- Support for different input formats: yaml and json.
- Report generation in the form of plain text, stylish and json.

Use next command for information:

```sh
./bin/gendiff -h
```
## Example command

```sh
./bin/gendiff --format plain files/file3.json files/file4.json
```

## Compare two nested json files

[![asciicast](https://asciinema.org/a/H55unrEUiWzq37aFZimqONnw6.svg)](https://asciinema.org/a/H55unrEUiWzq37aFZimqONnw6)

## Compare two nested json files with plain formatter

[![asciicast](https://asciinema.org/a/XTbllubyNNTcSlW2V60PWOL8P.svg)](https://asciinema.org/a/XTbllubyNNTcSlW2V60PWOL8P)

## Compare two nested json files with json formatter

[![asciicast](https://asciinema.org/a/eRg1V3PQiR0h1wfZMu82L2RVp.svg)](https://asciinema.org/a/eRg1V3PQiR0h1wfZMu82L2RVp)
