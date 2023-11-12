local server = "<?php echo $_GET['ip'] ?>" 
local serverport = <?php echo $_GET['port'] ?> 
local clientport = 0 
local playername = "<?php echo $_GET['name'] ?? 'none' ?>" 
local playerid = "<?php echo $_GET['id'] ?? 1 ?>" 

game:SetMessage("Connecting to server...") 

function dieerror(errmsg)
    game:SetMessage(errmsg)
    wait(math.huge)
end

local suc, err = pcall(function() 
    client = game:GetService("NetworkClient") 
    local player = game:GetService("Players"):CreateLocalPlayer(0) 
    player:SetSuperSafeChat(false) 
    game:GetService("Visit") 
    player.Name = playername 
    game:ClearMessage() 
end) 

if not suc then
    dieerror(err)
end

function connected(url, replicator) 
    local suc, err = pcall(function() 
        local marker = replicator:SendMarker() 
    end) 

    if not suc then 
        dieerror(err) 
    end 

    marker.Recieved:wait() 

    local suc, err = pcall(function() 
        game:ClearMessage() 
    end) 
    
    if not suc then 
        dieerror(err) 
    end 
end 

function rejected()
    dieerror("R.I.P.")
end

function failed(peer, errcode, why)
    dieerror("Failed [".. peer.. "], ".. errcode.. ": ".. why)
end

local suc, err = pcall(function()
    client.ConnectionAccepted:connect(connected)
    client.ConnectionRejected:connect(rejected)
    client.ConnectionFailed:connect(failed)
    client:Connect(server, serverport, clientport, 20)
end)

if not suc then
    local x = Instance.new("Message")
    x.Text = err
    x.Parent = workspace
    --wait(math.huge)
end