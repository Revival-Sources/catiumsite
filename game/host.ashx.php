Port = <?php echo $_GET['port']; ?>

epikhostingservice =  game:GetService("NetworkServer") 
epikhostingservice2 = game:GetService("RunService")

epikhostingservice:Start(Port,20) 
epikhostingservice2:Run() 

print("server so epic omfg....!") 

function onJoined(NewPlayer) 
	print("New player joined: "..NewPlayer.Name.."") 
	NewPlayer:LoadCharacter(true) 
	while wait() do 
		if NewPlayer.Character.Humanoid.Health == 0 then 
			wait(5) 
			NewPlayer:LoadCharacter(true)
		elseif NewPlayer.Character.Parent  == nil then 
			wait(5) 
			NewPlayer:LoadCharacter(true) 
		end 
	end 
end 

game.Players.PlayerAdded:connect(onJoined) 
