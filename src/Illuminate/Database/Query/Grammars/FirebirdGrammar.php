<?php namespace Illuminate\Database\Query\Grammars;


class FirebirdGrammar extends Grammar {
	public function columnize(array $columns)
	{
		return implode(', ', array_map(array($this, 'wrap'), $columns));
	}
	protected function compileColumns(Builder $query, $columns)
	{
		$select = $query->distinct ? 'select distinct ' : 'select ';
		if ($query->limit > 0)
		{
			$select .= 'first ' . (int)$query->limit . ' ';
		}
		if ($query->offset > 0)
		{
			$select .= 'skip ' . (int)$query->offset . ' ';
		}
		return $select . $this->columnize($columns);
	}
	protected function compileLimit(Builder $query, $limit)
	{
		return '';
	}
	protected function compileOffset(Builder $query, $offset)
	{
		return '';
	}
}
