#jqGrider


##Introduction


jqGrider is PHP library for generating jqGrid without typing JavaScript code. I created jqGrider for admin part of my applications. I wanted to without much effort present my database tables and datas into ajax grid.

jqGrid is at this moment most complete full-stack javascript grid. At this moment jqGrider supotring only basic and most needed functionality of jqGrid.

With jqGrider you can:


+ Present data from database table
+ Present array data in grid
+ Search grid data with any operator
+ Refresh data grid
+ Paginate results
+ Add custon anonymous function for columns

##Code examples

### basic usage of jgGrider
Your main action presenting grid

    public function action_grid()
    {
        $view = $this->app->forge('View', 'grid');
  	
  	
    	$grid = new \JqGrider\Grid(\JqGrider\Grid::DATA_TYPE_JSON);
    	$grid
    	->addColumn('ID', 'id', 200)
    	->addColumn('Full Name', 'name', 450)
    	->setUrl('http://localhost/fuelphp2/public/index.php/welcome/grid_data');
    
    	$view->set('grid_js', $grid->getJavaScriptCode(), false);
    	
    	return $view;
    }

Your view with grid

    <?=$grid_js?>
  
Ajax action which will return grid data with ajax call

    public function action_grid_data()
    {
    			
    	$grid = new \JqGrider\Grid(\JqGrider\Grid::DATA_TYPE_JSON);
    	$grid
    	->setRepository(new \App\Model\User())
    	->addColumn('ID', 'id', 200)
    	->addColumn('Full Name', 'name', 450);
    	
    	$grid->printRespositoryData();
    }
    
    
User model need to implement `IGridRepository` and define two methods `getData` and `countDataRows`.

`getData` can return object with data, and it must have properties like column names. Also it can returna array and key names also must be named as column names.

`countDataRows` will count data rows considering conditions.

Object `Conditions` representing search query, and it wil help you to generate database query to calculate rows in search conditions.


    
    namespace App\Model;
    
    use JqGrider\Data\IGridRepository;
    use JqGrider\Data\Conditions;
    
    class User implements IGridRepository
    {
    protected $pdo;
    
    public function __construct()
    {	
        // Connect on database with pdo object for example
    }
    
    public function getData(Conditions $dataConditions)
    {
    	$offset = $dataConditions->page == 1 ? 0 : $dataConditions->rowsLimit * ($dataConditions->page - 1);
    	$sql = 'SELECT id, name FROM user ';
    
    	if ($dataConditions->search === 'true')
    	{
    		$sql .= ' WHERE '.$dataConditions->searchCondition;
    	}
    	
    	$sql .=' ORDER BY '.$dataConditions->sortBy.' '.$dataConditions->sort;
    	
    	$sql .= ' LIMIT '.$dataConditions->rowsLimit.' OFFSET '.$offset;
    	
    	
    	$statement = $this->pdo->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
    	@$statement->bindParam(':grid_search_string',$dataConditions->searchString);
    	
    	if ($statement->execute())
    	{
    		return $statement->fetchAll(\PDO::FETCH_CLASS);
    	}
    }
    
    public function countDataRows(Conditions $dataConditions)
    {
    	$sql = 'SELECT count(id) FROM user';
    	if ($dataConditions->search === 'true')
    	{
    		$sql .= ' WHERE '.$dataConditions->searchCondition;
    	}		
    	if ($result = $this->pdo->query($sql))
    	{
    		return $result->fetchColumn();
    	}		
    }
    }
    
    
###Using anonymous functions

Anonymous function can be added into `Column` object to change column content.

            $nameFunction = function ($content)
    		{
    			return 'Member name is: '.$content;
    		};
    				
    		$grid = new Grid(Grid::DATA_TYPE_JSON);
    		$grid->addColumn('Full Name', 'name', 450, $nameFunction);
        
        
###Using local data for grid

    public function action_grid()
    {
    	$view = $this->app->forge('View', 'grid');
    	
    	
    	$grid = new Grid(Grid::DATA_TYPE_JSON);
    	$grid
    	->addColumn('ID', 'id', 200)
    	->addColumn('Full Name', 'name', 450);
    	
    	$grid->setLocalData(array(
    		array('id' => 4, 'name' => 'William Harrison'),
    		array('id' => 5, 'name' => 'Erick Hawkins'),
    		array('id' => 6, 'name' => 'Gene Autry'),
    	));
    
    	$view->set('grid_js', $grid->getJavaScriptCode(), false);
    	return $view;
    }
    
    

